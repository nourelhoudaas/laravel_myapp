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
        Schema::create('appartients', function (Blueprint $table) {
            $table->string('id_appar')->primary();
            $table->date('Date_op');
            $table->string('id_niv')->unique();
            $table->foreign('id_niv')->references('id_niv')->on('Niveau');
            $table->string('id_nin')->unique();
            $table->foreign('id_nin')->references('id_nin')->on('Employe');
            $table->string('id_p')->unique();
            $table->foreign('id_p')->references('id_p')->on('Employe');
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
