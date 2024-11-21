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
            $table->integer('id_fichier')->default(1);
            $table->string('ref_cng')->nullable();
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('ref_cong')->references('ref_cong')->on('type_congs');
            $table->foreign('id_sous_depart')->references('id_sous_depart')->on('sous_departements');
            $table->foreign('id_fichier')->references('id_fichier')->on('fichiers');
        });

       DB::table('conges')->insert([
            [


             
                'date_debut_cong' => '2024-10-22',
                'date_fin_cong' => '2024-10-30',
                'situation' => 'algérie',
                'nbr_jours' =>'8',

                'nbr_jours' =>10,
                'id_fichier' =>1,
                'situation_AR'=>'داخل الجزائر',
                'ref_cong'=>'RF001',
                'id_sous_depart'=>15,
                'id_nin'=>1254953,
                'id_p'=>123,
                'id_fichier'=>2


            ],
           

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
