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
        Schema::create('conges', function (Blueprint $table) {
            $table->integer('id_cong')->primary()->autoIncrement();
            $table->date('date_debut_cong');
            $table->date('date_fin_cong');
            $table->string('situation');
            $table->integer('nbr_jours');
            $table->string('situation_AR');
            $table->string('ref_cong');
            $table->integer('id_nin');
            $table->integer('id_sous_depart');
            $table->integer('id_p');
            $table->integer('id_fichier');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('ref_cong')->references('ref_cong')->on('type_congs');
            $table->foreign('id_sous_depart')->references('id_sous_depart')->on('sous_departements');
            $table->foreign('id_fichier')->references('id_fichier')->on('fichiers');
        });

       DB::table('conges')->insert([
            [


                'id_cong' => 1,
                'date_debut_cong' => '2024-08-10',
                'date_fin_cong' => '2024-08-20',
                'situation' => 'algérie',
                'nbr_jours' =>'10',

                'situation_AR'=>'داخل الجزائر',
                'ref_cong'=>'RF001',
                'id_sous_depart'=>15,
                'id_nin'=>1254953,
                'id_p'=>123,
                'id_fichier'=>2


            ],
            [
                'id_cong' => 2,
                'date_debut_cong' => '2024-07-20',
                'date_fin_cong' => '2024-07-22',
                'nbr_jours' =>'2',
                'situation' => 'algérie',
                'situation_AR'=>'خارج الجزائر',
                'ref_cong'=>'RF002',
                'id_sous_depart'=>10,
                'id_nin'=>254896989,
                'id_p'=>256,
                'id_fichier'=>1

            ]

            ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
