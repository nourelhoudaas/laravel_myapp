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
        Schema::create('sous_departements', function (Blueprint $table) {
            $table->integer('id_sous_depart')->primary()->autoIncrement();
            $table->integer('id_depart');
            $table->foreign('id_depart')->references('id_depart')->on('departements');
            $table->string('Nom_sous_depart')->unique();
            $table->string('Descriptif_sous_depart')->unique();
            $table->string('Nom_sous_depart_ar')->unique();
            $table->string('Descriptif_sous_depart_ar')->unique();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_departements');
    }
};
