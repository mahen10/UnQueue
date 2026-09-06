<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // "Meja 1", "Meja VIP", dll
            $table->unsignedInteger('number');
            $table->string('qr_token', 12)->unique(); // token pendek untuk URL /t/{token}
            $table->enum('status', ['available', 'occupied', 'dirty'])->default('available');
            $table->timestamps();

            $table->unique(['shop_id', 'number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
