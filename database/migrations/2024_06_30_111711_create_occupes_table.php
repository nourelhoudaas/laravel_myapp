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
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('id_post')->references('id_post')->on('posts');
        });
        DB::table('occupes')->insert([
            [
                'id_occup' => 4,
                'date_recrutement' => '2024-07-03',
                'echellant' => 13,
                'id_nin' => 254896989,
                'id_p' => 256,
                'id_post' => 20,
                'ref_PV'=>'1N'
            ],
            [
                'id_occup' => 10,
                'date_recrutement' => '2024-04-14',
                'echellant' => 13,
                'id_nin' => 1254953,
                'id_p' => 123,
                'id_post' => 2,
                'ref_PV'=>'2N'
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
