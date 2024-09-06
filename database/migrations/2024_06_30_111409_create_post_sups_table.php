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
        Schema::create('post_sups', function (Blueprint $table) {
            $table->integer('id_postsup')->primary()->autoIncrement();
            $table->string('Nom_postsup');
            $table->string('Nom_postsup_ar');
            $table->string('Niveau_sup');
            $table->integer('point_indsup');
            

          

        });
        DB::table('post_sups')->insert([
            [
             
                'Nom_postsup' => 'chargé Reseaux',
                'Nom_postsup_ar' => 'مكلف بالشبكات',
                'Niveau_sup' => 1,
                
                'point_indsup' => 140,


            ],
            [
               
                'Nom_postsup' => 'chargé Systeme information',
                'Nom_postsup_ar' => 'مكلف بانظمة المعلوماتية',
                'Niveau_sup' => 3,
              
                'point_indsup' => 214,
            ]

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_sups');
    }
};
