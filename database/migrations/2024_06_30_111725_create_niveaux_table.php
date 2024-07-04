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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->integer('id_niv')->primary()->autoIncrement();
            $table->string('Nom_niv');
            $table->string('Specialité');
            $table->string('Descriptif_niv')->unique();
            $table->string('Nom_niv_ar');
            $table->string('Specialité_ar');
            $table->string('Descriptif_niv_ar')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
