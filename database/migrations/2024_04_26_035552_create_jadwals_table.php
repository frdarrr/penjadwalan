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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('dosen_id')->constrained('dosens')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('kd_matkul');
            $table->foreignId('lab_id')->constrained('labs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('hari');
            $table->string('jam');
            $table->string('kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
