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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id_post')->primary()->autoIncrement();
            $table->string('Nom_post');
            $table->integer('Grade_post');
            $table->string('Nom_post_ar');
            $table->integer('id_secteur');
            $table->foreign('id_secteur')->references('id_secteur')->on('secteurs');
        });

        DB::table('posts')->insert([
            [
                'id_post' => 2,
                'Nom_post' => 'ingénieur en informatique',
                'Grade_post' => 1,
                'Nom_post_ar' => 'مهندس دولة في الاعلام الالي',
                'id_secteur' => 1,


            ],
            [
                'id_post' => 20,
                'Nom_post' => 'technicien supérieur en info',
                'Grade_post' => 2,
                'Nom_post_ar' => 'تقني في الاعلام الالي',
                'id_secteur' => 2,
            ]

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
