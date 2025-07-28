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
        Schema::create('type_congs', function (Blueprint $table) {
            $table->string('ref_cong')->primary()->autoIncrement();
            $table->string('titre_cong');
            $table->string('Descriptif');
            $table->string('titre_cong_ar');
            $table->string('Descriptif_ar');
        });

        DB::table('type_congs')->insert([
            [  
            
            
                'ref_cong' => 'RF001',
                'titre_cong' => 'Annuel',
                'Descriptif' => 'congé annuel',
                'titre_cong_ar' =>'عطلة سنوية',
                'Descriptif_ar' => 'عطلة سنوية'
                
               
            ],
            [
                'ref_cong' => 'RF002',
                'titre_cong' => 'Maladie',
                'Descriptif' => 'congé maladie',
                'titre_cong_ar' =>'عطلة مرضية',
                'Descriptif_ar' => 'عطلة مرضية'
            ],
           [  
            
            
                'ref_cong' => 'RF003',
                'titre_cong' => 'matérnité',
                'Descriptif' => 'congé matérnité',
                'titre_cong_ar' =>'عطلة الامومة',
                'Descriptif_ar' => 'عطلة الامومة'
                
               
            ],
            [
                'ref_cong' => 'RF004',
                'titre_cong' => 'Sans solde ',
                'Descriptif' => 'congé sans solde',
                'titre_cong_ar' =>'عطلة بدون دفع',
                'Descriptif_ar' => 'عطلة بدون دفع'
            ]
               
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_congs');
    }
};
