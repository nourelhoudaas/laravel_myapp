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
        Schema::create('stocke', function (Blueprint $table) {
            $table->integer('id_stocke')->primary()->autoIncrement();
            $table->date('date_insertion');
            $table->string('ref_Dossier');
            $table->string('sous_d');
            $table->integer('id_fichier');
            $table->integer('id');
            $table->string('mac');
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('id_fichier')->references('id_fichier')->on('fichiers');
            $table->foreign('ref_Dossier')->references('ref_Dossier')->on('dossiers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocke');
    }
};
