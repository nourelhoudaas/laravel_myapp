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
            $table->integer('id_feedback')->primary()->autoIncrement();
            $table->string('type_feedback');
            $table->string('Descriptif_feedback');
            $table->string('type_feedback_ar');
            $table->string('Descriptif_feedback_ar');
            $table->integer('id_nin');
            $table->integer('id_p');
            $table->integer('id_post');
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
