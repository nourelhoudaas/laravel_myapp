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
        Schema::create('fichiers', function (Blueprint $table) {
            $table->integer('id_fichier')->primary()->autoIncrement();
            $table->string('nom_fichier');
            $table->string('hash_fichier')->unique();
            $table->string('taille_fichier');
            $table->string('type_fichier');
            $table->date('date_cree_fichier');
        });
 // Définir la valeur de départ de l'auto-incrémentation à 2
 DB::statement('ALTER TABLE fichiers AUTO_INCREMENT = 2');


        DB::table('fichiers')->insert([
            [

                'nom_fichier' => 'fff',
                'hash_fichier' => 'fff',
                'taille_fichier' => '20',
                'type_fichier' =>'img',
                'date_cree_fichier' =>'2024-01-11',



            ],
            [

                'nom_fichier' => 'ggg',
                'hash_fichier' => 'ggggg',
                'taille_fichier' => '20',
                'type_fichier' =>'img',
                'date_cree_fichier' =>'2024-08-11',

            ]

            ]);



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichiers');
    }
};
