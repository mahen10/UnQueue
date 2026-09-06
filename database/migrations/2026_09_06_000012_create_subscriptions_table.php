<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2); // Rp 150.000
            $table->timestamp('period_start');
            $table->timestamp('period_end');
            $table->enum('status', ['pending', 'active', 'expired', 'failed'])->default('pending');
            $table->string('gateway_reference')->nullable()->unique(); // ID invoice Xendit
            $table->string('xendit_invoice_url')->nullable();
            $table->json('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['shop_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
