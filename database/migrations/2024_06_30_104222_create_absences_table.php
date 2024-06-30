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
        Schema::create('absences', function (Blueprint $table) {
            $table->integer('id_abs')->primary();
            $table->date('date_abs');
            $table->date('heure_abs');
            $table->integer('id_nin')->unique();
            $table->integer('id_p')->unique();
            $table->string('id_sous_depart');
            $table->foreign('id_nin')->references('id_nin')->on('Employe');
            $table->foreign('id_sous_depart')->references('id_sous_depart')->on('Sous_departement');
            $table->foreign('id_p')->references('id_p')->on('Employe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
