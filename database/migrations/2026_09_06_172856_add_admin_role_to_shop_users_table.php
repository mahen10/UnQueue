<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shop_users', function (Blueprint $table) {
            $table->string('role')->change();
        });
        
        DB::statement('ALTER TABLE shop_users DROP CONSTRAINT IF EXISTS shop_users_role_check');
        DB::statement("ALTER TABLE shop_users ADD CONSTRAINT shop_users_role_check CHECK (role::text = ANY (ARRAY['owner'::character varying, 'admin'::character varying, 'kasir'::character varying, 'kitchen'::character varying, 'waiter'::character varying]::text[]))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE shop_users DROP CONSTRAINT IF EXISTS shop_users_role_check');
        DB::statement("ALTER TABLE shop_users ADD CONSTRAINT shop_users_role_check CHECK (role::text = ANY (ARRAY['owner'::character varying, 'kasir'::character varying, 'kitchen'::character varying, 'waiter'::character varying]::text[]))");
    }
};
