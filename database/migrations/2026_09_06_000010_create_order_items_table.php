<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('menu_item_id')->nullable()->constrained()->nullOnDelete();
            // SNAPSHOT: data disalin dari menu saat order dibuat — tidak berubah walau menu diedit/dihapus
            $table->string('item_name');           // snapshot nama
            $table->decimal('item_price', 12, 2); // snapshot harga satuan
            $table->integer('quantity');
            $table->json('modifiers')->nullable();  // snapshot pilihan modifier: [{"name":"Ukuran","value":"Large","price":5000}]
            $table->text('notes')->nullable();       // catatan khusus pelanggan
            $table->enum('status', ['pending', 'processing', 'done', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
