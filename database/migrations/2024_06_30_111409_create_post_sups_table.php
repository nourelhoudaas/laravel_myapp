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
        Schema::create('post_sups', function (Blueprint $table) {
            $table->integer('id_postsup')->primary()->autoIncrement();
            $table->string('Nom_postsup');
            $table->string('Nom_postsup_ar');
            $table->string('Niveau_sup');
            $table->integer('point_indsup');
            

          

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_sups');
    }
};
