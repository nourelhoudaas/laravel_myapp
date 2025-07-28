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
        Schema::create('generes', function (Blueprint $table) {
            $table->integer('id_genr')->primary()->autoIncrement();
            $table->date('date_creation');
            $table->string('ref_Dossier')->unique();
            $table->integer('id_nin');
            $table->integer('id_p');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('ref_Dossier')->references('ref_Dossier')->on('dossiers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generes');
    }
};
