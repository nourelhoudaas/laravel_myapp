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
        Schema::create('contients', function (Blueprint $table) {
            $table->integer('id_contient')->primary()->autoIncrement();
            $table->integer('id_post');
            $table->integer('id_postsup')->nullable();
            $table->string('id_fonction')->nullable();
            $table->foreign('id_postsup')->references('id_postsup')->on('post_sups');
            $table->foreign('id_fonction')->references('id_fonction')->on('fonctions');
            $table->foreign('id_post')->references('id_post')->on('posts');
            $table->integer('id_sous_depart');
            $table->foreign('id_sous_depart')->references('id_sous_depart')->on('sous_departements');
        });


        DB::table('contients')->insert([
            [
                'id_contient' => 2,
                'id_sous_depart' => 10,
                'id_post' => 20,
                'id_postsup' => null, 
                'id_fonction' => null 


            ],
            [
                'id_contient' => 50,
                'id_sous_depart' => 15,
                'id_post' => 2,
                'id_postsup' => null,  
                'id_fonction' => null 
            ],
            [
             'id_contient' => 3,
            'id_sous_depart' => 15,
            'id_post' => 20,
            'id_postsup' => null, 
            'id_fonction' => null 


        ],
        [
            'id_contient' => 10,
            'id_sous_depart' => 10,
            'id_post' => 2,
            'id_postsup' => null, 
            'id_fonction' => null 

        ]

            ]);



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contients');
    }
};
