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
            $table->integer('NSS')->unique();
            $table->string('Nom_emp');
            $table->string('Prenom_emp');
            $table->string('Nom_ar_emp');
            $table->string('Prenom_ar_emp');
            $table->date('Date_nais');
            $table->string('Lieu_nais');
            $table->string('Lieu_nais_ar');
            $table->string('adress');
            $table->string('adress_ar');
            $table->string('prenom_pere');
            $table->string('prenom_mere');
            $table->string('nom_mere');
            $table->string('prenom_pere_ar');
            $table->string('prenom_mere_ar');
            $table->string('nom_mere_ar');
            $table->date('Date_nais_pere');
            $table->date('Date_nais_mere');
            $table->string('situation_familliere');
            $table->string('situation_familliere_ar');
            $table->integer('nbr_enfants');
            $table->string('sexe');
            $table->string('email')->nullable();;
            $table->string('Phone_num')->unique();


        
        });

        DB::table('employes')->insert([
            [  
          
        
                'id_emp' => 1,
                'id_nin' => 1254953,
                'id_p' => 123,
                'NSS' =>18505482,
                'Nom_emp' => 'boumediene',
                'Prenom_emp' => 'fadia',
                'Nom_ar_emp' => 'بومدين',
                'Prenom_ar_emp' => 'فادية',
                'Date_nais' => '2000-01-11',
                'Lieu_nais' => 'alger',
                'Lieu_nais_ar' => 'الجزائر',
                'adress' => 'alger',
                'adress_ar' => 'الجزائر',
                'sexe' => 'femme',
                'email' => 'fagmail.com',
                'Phone_num' => '0124367555',
                'prenom_pere' => 'moh',
                'prenom_mere' =>'fff'

               
               
            ],
            [
                'id_emp' => 2,
                'id_nin' => 254896989,
                'id_p' => 256,
                'Nom_emp' => 'boum',
                'Prenom_emp' => 'fad',
                'Nom_ar_emp' => 'بومد',
                'Prenom_ar_emp' => 'فاد',
                'Date_nais' => '2024-07-01',
                'Lieu_nais' => 'alger',
                'Lieu_nais_ar' => 'الجزائر',
                'adress' => 'alger',
                'adress_ar' =>'الجزائر' ,
                'sexe' => 'femme',
                'email' => 'fgmail.com',
                'Phone_num' => '01573645525',
            ]
               
            ]);
    }
    
     /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
