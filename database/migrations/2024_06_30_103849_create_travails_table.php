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
        Schema::create('travails', function (Blueprint $table) {
            $table->integer('id_travail')->primary()->autoIncrement();
            $table->date('date_chang');
            $table->date('date_installation');
            $table->float('notation');
            $table->integer('id_nin')->unique();
            $table->string('id_sous_depart');
            $table->integer('id_p')->unique();
            $table->string('id_bureau')->unique();
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_sous_depart')->references('id_sous_depart')->on('Sous_departement');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('id_bureau')->references('id_bureau')->on('bureaus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travails');
    }
};
