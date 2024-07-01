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
        Schema::create('feedback', function (Blueprint $table) {
            $table->string('id_feedback')->primary();
            $table->string('type_feedback');
            $table->string('Descriptif');
            $table->integer('id_nin')->unique();
            $table->integer('id_p')->unique();
            $table->string('id_post');
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
        Schema::dropIfExists('feedback');
    }
};
