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
        //appartient==diplome  dnc id_appr =ref du diplome
        Schema::create('appartients', function (Blueprint $table) {
            $table->string('id_appar')->primary();
            $table->date('Date_op');
            $table->integer('id_niv');
            $table->foreign('id_niv')->references('id_niv')->on('niveaux');
            $table->integer('id_nin');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->integer('id_p');
            $table->foreign('id_p')->references('id_p')->on('employes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartients');
    }
};
