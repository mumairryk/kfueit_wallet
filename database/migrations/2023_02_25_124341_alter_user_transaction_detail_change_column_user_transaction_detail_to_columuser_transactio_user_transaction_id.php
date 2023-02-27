<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_transaction_detail', function (Blueprint $table) {
            $table->renameColumn('user_transaction_detail', 'user_transaction_id');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_transaction_detail', function (Blueprint $table) {
            $table->renameColumn('user_transaction_id', 'user_transaction_detail');
            //
        });
    }
};
