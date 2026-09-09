<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\MenuModifier;
use App\Models\Shop;
use App\Models\ShopUser;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DemoShopSeeder extends Seeder
{
    public function run(): void
    {
        // ── Demo Owner ────────────────────────────────────────────────
        $owner = User::firstOrCreate(
            ['phone' => '08111111111'],
            [
                'uq_id'    => 'UQ100001',
                'name'     => 'Budi Santoso (Demo Owner)',
                'phone'    => '08111111111',
                'email' => 'owner@demo.com', 'email_verified_at' => now(),
                'password' => Hash::make('demo1234'),
            ]
        );

        // ── Demo Shop ─────────────────────────────────────────────────
        $shop = Shop::firstOrCreate(
            ['slug' => 'kopi-demo'],
            [
                'owner_id'              => $owner->id,
                'name'                  => 'Kopi Demo Café',
                'slug'                  => 'kopi-demo',
                'address'               => 'Jl. Demo No. 1, Jakarta',
                'phone'                 => '02112345678',
                'open_time'             => '08:00:00',
                'close_time'            => '22:00:00',
                'tax_percent'           => 11.00,
                'service_charge_percent'=> 5.00,
                // Aktif 1 tahun untuk development — tanpa perlu bayar
                'subscription_end_date' => Carbon::now()->addYear(),
                'subscription_override' => null,
            ]
        );

        // ── Owner sebagai shop_user ───────────────────────────────────
        ShopUser::firstOrCreate(
            ['shop_id' => $shop->id, 'user_id' => $owner->id, 'role' => 'owner'],
            ['status' => 'active', 'joined_at' => now()]
        );

        // ── Demo Karyawan ─────────────────────────────────────────────
        $kasir = User::firstOrCreate(
            ['phone' => '08222222222'],
            [
                'uq_id'    => 'UQ200001',
                'name'     => 'Sari (Demo Kasir)',
                'phone'    => '08222222222',
                'email' => 'kasir@demo.com', 'email_verified_at' => now(),
                'password' => Hash::make('demo1234'),
            ]
        );
        ShopUser::firstOrCreate(
            ['shop_id' => $shop->id, 'user_id' => $kasir->id, 'role' => 'kasir'],
            ['status' => 'active', 'joined_at' => now()]
        );

        $kitchen = User::firstOrCreate(
            ['phone' => '08333333333'],
            [
                'uq_id'    => 'UQ300001',
                'name'     => 'Reza (Demo Kitchen)',
                'phone'    => '08333333333',
                'email' => 'kitchen@demo.com', 'email_verified_at' => now(),
                'password' => Hash::make('demo1234'),
            ]
        );
        ShopUser::firstOrCreate(
            ['shop_id' => $shop->id, 'user_id' => $kitchen->id, 'role' => 'kitchen'],
            ['status' => 'active', 'joined_at' => now()]
        );

        $waiter = User::firstOrCreate(
            ['phone' => '08444444444'],
            [
                'uq_id'    => 'UQ400001',
                'name'     => 'Dina (Demo Waiter)',
                'phone'    => '08444444444',
                'email' => 'waiter@demo.com', 'email_verified_at' => now(),
                'password' => Hash::make('demo1234'),
            ]
        );
        ShopUser::firstOrCreate(
            ['shop_id' => $shop->id, 'user_id' => $waiter->id, 'role' => 'waiter'],
            ['status' => 'active', 'joined_at' => now()]
        );

        // ── Kategori Menu ─────────────────────────────────────────────
        $catMinuman = Category::firstOrCreate(
            ['shop_id' => $shop->id, 'name' => 'Minuman'],
            ['sort_order' => 1, 'is_active' => true]
        );
        $catMakanan = Category::firstOrCreate(
            ['shop_id' => $shop->id, 'name' => 'Makanan'],
            ['sort_order' => 2, 'is_active' => true]
        );
        $catSnack = Category::firstOrCreate(
            ['shop_id' => $shop->id, 'name' => 'Snack'],
            ['sort_order' => 3, 'is_active' => true]
        );

        // ── Item Menu ─────────────────────────────────────────────────
        $esCopi = MenuItem::firstOrCreate(
            ['shop_id' => $shop->id, 'name' => 'Es Kopi Susu'],
            [
                'category_id'  => $catMinuman->id,
                'description'  => 'Kopi susu segar dengan es batu yang menyegarkan.',
                'price'        => 25000,
                'is_available' => true,
                'labels'       => ['Signature', 'Best Seller'],
                'sort_order'   => 1,
            ]
        );

        $matchaLatte = MenuItem::firstOrCreate(
            ['shop_id' => $shop->id, 'name' => 'Matcha Latte'],
            [
                'category_id'  => $catMinuman->id,
                'description'  => 'Matcha premium dengan susu segar.',
                'price'        => 30000,
                'is_available' => true,
                'labels'       => ['Signature'],
                'sort_order'   => 2,
            ]
        );

        $nasiGoreng = MenuItem::firstOrCreate(
            ['shop_id' => $shop->id, 'name' => 'Nasi Goreng Spesial'],
            [
                'category_id'  => $catMakanan->id,
                'description'  => 'Nasi goreng dengan telur, ayam, dan sayuran pilihan.',
                'price'        => 35000,
                'is_available' => true,
                'labels'       => ['Spicy', 'Best Seller'],
                'sort_order'   => 1,
            ]
        );

        $kentangGoreng = MenuItem::firstOrCreate(
            ['shop_id' => $shop->id, 'name' => 'Kentang Goreng'],
            [
                'category_id'  => $catSnack->id,
                'description'  => 'Kentang goreng renyah dengan saus pilihan.',
                'price'        => 18000,
                'is_available' => true,
                'labels'       => [],
                'sort_order'   => 1,
            ]
        );

        // ── Modifier ──────────────────────────────────────────────────
        MenuModifier::firstOrCreate(
            ['menu_item_id' => $esCopi->id, 'name' => 'Ukuran'],
            [
                'is_required' => true,
                'options'     => [
                    ['label' => 'Regular (250ml)', 'price' => 0],
                    ['label' => 'Large (500ml)',   'price' => 8000],
                ],
                'sort_order' => 1,
            ]
        );

        MenuModifier::firstOrCreate(
            ['menu_item_id' => $esCopi->id, 'name' => 'Tingkat Gula'],
            [
                'is_required' => false,
                'options'     => [
                    ['label' => 'Normal',     'price' => 0],
                    ['label' => 'Less Sugar', 'price' => 0],
                    ['label' => 'No Sugar',   'price' => 0],
                ],
                'sort_order' => 2,
            ]
        );

        MenuModifier::firstOrCreate(
            ['menu_item_id' => $nasiGoreng->id, 'name' => 'Tingkat Pedas'],
            [
                'is_required' => false,
                'options'     => [
                    ['label' => 'Tidak Pedas', 'price' => 0],
                    ['label' => 'Pedas',       'price' => 0],
                    ['label' => 'Extra Pedas', 'price' => 0],
                ],
                'sort_order' => 1,
            ]
        );

        // ── Meja ──────────────────────────────────────────────────────
        for ($i = 1; $i <= 10; $i++) {
            Table::firstOrCreate(
                ['shop_id' => $shop->id, 'number' => $i],
                [
                    'name'   => "Meja {$i}",
                    'status' => 'available',
                ]
            );
        }

        $this->command->info("✅ Demo shop seeded: Kopi Demo Café");
        $this->command->info("   Owner  : owner@demo.com / demo1234");
        $this->command->info("   Kasir  : kasir@demo.com / demo1234");
        $this->command->info("   Kitchen: kitchen@demo.com / demo1234");
        $this->command->info("   Waiter : waiter@demo.com / demo1234");
        $this->command->info("   Meja   : 10 meja (Meja 1 - Meja 10)");
    }
}
