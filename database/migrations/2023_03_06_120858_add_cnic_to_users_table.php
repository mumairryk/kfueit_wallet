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
            $table->string('cnic')->nullable()->after('username');
            $table->string('uuid')->unique()->nullable()->after('id');
            $table->time('expiry_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cnic');
            $table->dropColumn('uuid');
            $table->dropColumn('expiry_date');
        });
    }
};
