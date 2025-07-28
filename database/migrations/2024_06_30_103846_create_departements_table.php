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
        Schema::create('departements', function (Blueprint $table) {
            $table->integer('id_depart')->primary()->autoIncrement();
            $table->string('Nom_depart')->unique();
            $table->string('Descriptif_depart')->unique();
            $table->string('Nom_depart_ar')->unique();
            $table->string('Descriptif_depart_ar')->unique();

        });
        DB::table('departements')->insert([
            [
              
                'Nom_depart' => "Développement et de l'Investissement",
                'Descriptif_depart' => "Développement et de l'Investissement",
                'Nom_depart_ar' => '  التطوير و الاستثمار',
                'Descriptif_depart_ar' => '  التطوير و الاستثمار',
               
            ], 
            [
             
                'Nom_depart' => "Administration et des Moyens",
                'Descriptif_depart' => "Administration et des Moyens",
                'Nom_depart_ar' => 'الإدارة والوسائل ',
                'Descriptif_depart_ar' => 'الإدارة والوسائل',
            ]
            , 
            [
             
                'Nom_depart' => "La Coopération et de la Formation",
                'Descriptif_depart' => "La Coopération et de la Formation",
                'Nom_depart_ar' => 'التعاون  والتكوين ',
                'Descriptif_depart_ar' => 'التعاون  والتكوين',
            ]
            , 
            [
             
                'Nom_depart' => "La Communication Institutionnelle",
                'Descriptif_depart' => "La Communication Institutionnelle",
                'Nom_depart_ar' => 'الاتصال المؤسساتي',
                'Descriptif_depart_ar' => 'الاتصال المؤسساتي',
            ]
            , 
            [
             
                'Nom_depart' => "Affaires Juridiques, de la Documentation et des Archives",
                'Descriptif_depart' => "Affaires Juridiques, de la Documentation et des Archives",
                'Nom_depart_ar' => 'الشؤون  القانونية  والتوثيق  والأرشيف',
                'Descriptif_depart_ar' => 'الشؤون  القانونية  والتوثيق  والأرشيف',
            ]
            , 
            [
             
                'Nom_depart' => "Médias",
                'Descriptif_depart' => "Médias",
                'Nom_depart_ar' => ' وسائل  الإعلام',
                'Descriptif_depart_ar' => ' وسائل  الإعلام',
            ]
           
               
            ]);
    }



    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
    }
};
