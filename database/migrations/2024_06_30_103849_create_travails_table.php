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
        Schema::create('travails', function (Blueprint $table) {
            $table->integer('id_travail')->primary()->autoIncrement();
            $table->date('date_chang');
            $table->date('date_installation');
            $table->float('notation');
            $table->integer('id_nin');
            $table->integer('id_sous_depart');
            $table->integer('id_p');
            $table->integer('id_bureau');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_sous_depart')->references('id_sous_depart')->on('sous_departements');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('id_bureau')->references('id_bureau')->on('bureaus');
        });

        DB::table('travails')->insert([
            [
                'id_travail' => 14,
                'date_chang' => '2024-07-01',
                'date_installation' => '2023-07-01',
                'notation' =>17,
                'id_nin' => 254896989,
                'id_sous_depart' => 10,
                'id_p' =>256,
                'id_bureau' => 5,
                
            ], 
            [
                'id_travail' => 20,
                'date_chang' => '2024-04-14',
                'date_installation' => '2024-04-14',
                'notation' =>20,
                'id_nin' => 1254953,
                'id_sous_depart' => 15,
                'id_p' =>123,
                'id_bureau' => 5,
            ],
        ]);
    }
  
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travails');
    }
};
