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
        Schema::create('employes', function (Blueprint $table) {
            $table->string('id_emp')->primary();
            $table->integer('id_nin')->unique();
            $table->string('Nom_emp');
            $table->string('Prenom_emp');
            $table->string('Nom_ar_emp');
            $table->string('Prenom_ar_emp');
            $table->string('Prenom_ar_emp');
            $table->string('Date_nais');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
