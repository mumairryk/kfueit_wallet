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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
            $table->datetime('last_login')->nullable()->after('remember_token');
            $table->string('last_login_ip')->nullable()->after('remember_token');
            $table->integer('user_type_id')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('last_login');
            $table->dropColumn('last_login_ip');
            $table->dropColumn('user_type_id');
        });
    }
};
