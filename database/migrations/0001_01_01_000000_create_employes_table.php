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
            $table->integer('id_emp')->primary()->autoIncrement();
            $table->integer('id_nin')->unique();
            $table->integer('id_p')->unique();
            $table->string('Nom_emp');
            $table->string('Prenom_emp');
            $table->string('Nom_ar_emp');
            $table->string('Prenom_ar_emp');
            $table->date('Date_nais');
            $table->string('Lieu_nais');
            $table->string('Lieu_nais_ar');
            $table->string('adress');
            $table->string('adress_ar');
            $table->string('sexe');
            $table->string('email')->nullable();;
            $table->string('Phone_num')->unique();

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
