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
        Schema::create('logs', function (Blueprint $table) {
            $table->integer('id_log')->primary()->autoIncrement();
            $table->string('action');
            $table->integer('id_nin');
            $table->integer('id');
            $table->string('adresse_mac');
            $table->timestamp('date_action');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
