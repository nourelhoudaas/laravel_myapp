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
        Schema::create('secteurs', function (Blueprint $table) {
            $table->integer('id_secteur');
            $table->string(' Nom_secteur');
            $table->string('Nom_secteur_ar');
            $table->integer('id_filiere');
            $table->foreign('id_filiere')->references('id_filiere')->on('filieres');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secteurs');
    }
};
