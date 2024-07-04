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
        Schema::create('occupes', function (Blueprint $table) {
            $table->integer('id_occup')->primary()->autoIncrement();
            $table->date('date_recrutement');
            $table->float('echellant');
            $table->integer('id_nin');
            $table->integer('id_p');
            $table->integer('id_post')->unique();
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('id_post')->references('id_post')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupes');
    }
};
