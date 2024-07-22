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
        Schema::create('fichiers', function (Blueprint $table) {
            $table->integer('id_fichier')->primary()->autoIncrement();
            $table->string('nom_fichier');
            $table->integer('hash_fichier')->unique();
            $table->integer('taille_fichier');
            $table->integer('date_cree_fichier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichiers');
    }
};
