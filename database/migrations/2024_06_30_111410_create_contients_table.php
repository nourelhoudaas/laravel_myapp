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
        Schema::create('contients', function (Blueprint $table) {
            $table->integer('id_contient')->primary();
            $table->string('id_post');
            $table->foreign('id_post')->references('id_post')->on('posts');
            $table->string('id_sous_depart');
            $table->foreign('id_sous_depart')->references('id_sous_depart')->on('sous_departements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contients');
    }
};
