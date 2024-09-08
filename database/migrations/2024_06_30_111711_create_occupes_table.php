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
        Schema::create('occupes', function (Blueprint $table) {
            $table->integer('id_occup')->primary()->autoIncrement();
            $table->date('date_recrutement');
            $table->float('echellant');
            $table->integer('id_nin');
            $table->integer('id_p');
            $table->integer('id_post');
            $table->string('ref_PV');
            $table->string('ref_Decision')->default('New');
            $table->string('ref_base');

            $table->integer('id_postsup')->nullable();
            $table->string('id_fonction')->nullable();
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('id_post')->references('id_post')->on('posts');
            $table->foreign('id_postsup')->references('id_postsup')->on('post_sups');
            $table->foreign('id_fonction')->references('id_fonction')->on('fonctions');
        });
        DB::table('occupes')->insert([
            [
                'id_occup' => 4,
                'date_recrutement' => '2024-07-03',
                'echellant' => 13,
                'id_nin' => 254896989,
                'id_p' => 256,
                'id_post' => 20,
                'ref_PV'=>'1N',
                'ref_base'=>'1N'
            ],
            [
                'id_occup' => 10,
                'date_recrutement' => '2024-04-14',
                'echellant' => 13,
                'id_nin' => 1254953,
                'id_p' => 123,
                'id_post' => 2,
                'ref_PV'=>'2N',
                'ref_base'=>'2N'
            ],

            ]);


    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupes');
    }
};
