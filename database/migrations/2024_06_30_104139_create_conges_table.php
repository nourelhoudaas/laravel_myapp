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
            $table->string('ref_cong')->unique();
            $table->integer('id_nin');
            $table->integer('id_p');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('ref_cong')->references('ref_cong')->on('type_congs');
        });

       /* DB::table('conges')->insert([
            [  
            
            
                'id_cong' => 1,
                'date_debut_cong' => '10/08/2024',
                'date_fin_cong' => '20/08/2024',
                'nbr_jours' =>'10',
                'situation' => 'algérie',
                'ref_cong'=>'RF001'
               
            ],
            [
                'id_cong' => 2,
                'date_debut_cong' => '20/07/2024',
                'date_fin_cong' => '22/07/2024',
                'nbr_jours' =>'2',
                'situation' => 'algérie',
                'ref_cong'=>'RF002'
                
            ]
               
            ]);
*/

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
