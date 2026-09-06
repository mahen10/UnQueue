<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->string('xendit_public_key')->nullable()->after('subscription_override');
            $table->string('xendit_secret_key', 512)->nullable()->after('xendit_public_key');
            $table->string('xendit_webhook_token')->nullable()->after('xendit_secret_key');
        });
    }

    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn(['xendit_public_key', 'xendit_secret_key', 'xendit_webhook_token']);
        });
    }
};
