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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->integer('id_niv')->primary()->autoIncrement();
            $table->string('Nom_niv');
            $table->string('Specialité');
            $table->string('Descriptif_niv')->unique();
            $table->string('Nom_niv_ar');
            $table->string('Specialité_ar');
            $table->string('Descriptif_niv_ar')->unique();
            $table->integer('id_post');
            $table->foreign('id_post')->references('id_post')->on('posts');


        });
        DB::table('niveaux')->insert([
        [
            'id_niv' => 5,
            'Nom_niv' => 'master2',
            'Specialité' => 'rsd',
            'Descriptif_niv' => 'réseaux et systèmes distribués',
            'Nom_niv_ar' => 'ماستر2',
            'Specialité_ar' => 'نظام الشبكات',
           'Descriptif_niv_ar' => 'ماستر2',
           'id_post' => 2,
            
        ],  
        [
            'id_niv' => 12,
            'Nom_niv' => 'master2',
            'Specialité' => 'finnance',
            'Descriptif_niv' => 'finnance',
            'Nom_niv_ar' => 'ماستر2',
            'Specialité_ar' => 'مالية',
           'Descriptif_niv_ar' => 'مالية',
           'id_post' => 20,
        ],
           
        ]);
    }

   
   
   
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
