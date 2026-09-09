<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['phone' => '08000000000'],
            [
                'uq_id'    => 'UQ000001',
                'name'     => 'Super Admin',
                'phone'    => '08000000000',
                'email' => 'admin@unqueue.app', 'email_verified_at' => now(),
                'password' => Hash::make('superadmin123'),
                'is_banned' => false,
                'is_super_admin' => true,
            ]
        );

        $this->command->info('✅ Super Admin created: admin@unqueue.app / superadmin123');
    }
}
