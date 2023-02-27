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
        Schema::table('service_type', function (Blueprint $table) {
            $table->integer('unit_rate')->nullable()->after('desc');
            $table->text('unit_type')->nullable()->after('unit_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_type', function (Blueprint $table) {
            $table->dropColumn('unit_rate');
            $table->dropColumn('unit_type');
        });
    }
};
