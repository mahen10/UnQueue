<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->enum('method', ['qris', 'gopay', 'shopeepay', 'ovo', 'dana', 'va', 'cash', 'other'])->nullable();
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'success', 'failed', 'refunded', 'expired'])->default('pending');
            $table->string('gateway_reference')->nullable()->unique(); // ID transaksi dari Xendit
            $table->string('xendit_invoice_url')->nullable();          // URL halaman bayar Xendit
            $table->json('gateway_response')->nullable();              // raw response dari Xendit (untuk debugging)
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['shop_id', 'status']);
            $table->index('gateway_reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
