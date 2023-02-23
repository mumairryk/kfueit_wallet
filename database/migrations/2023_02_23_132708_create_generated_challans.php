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
        Schema::create('generated_challans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('user_type_id');
            $table->string('name');
            $table->string('father_name');
            $table->string('cnic');
            $table->string('depositor_cnic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_challans');
    }
};
