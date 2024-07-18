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
        //appartient==diplome  dnc id_appr =ref du diplome
        Schema::create('appartients', function (Blueprint $table) {
            $table->integer('id_appar')->primary();
            $table->date('Date_op');
            $table->integer('id_niv');
            $table->foreign('id_niv')->references('id_niv')->on('niveaux');
            $table->integer('id_nin');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->integer('id_p');
            $table->foreign('id_p')->references('id_p')->on('employes');
        });
        DB::table('appartients')->insert([
            [
                'id_appar' => 1,
                'Date_op' => '2023-07-11',
                'id_niv' => 1,
                'id_nin' => 1254953,
                'id_p' => 123,
            ],
            [
                'id_appar' => 15,
                'Date_op' => '2024-03-13',
                'id_niv' => 2,
                'id_nin' => 254896989,
                'id_p' => 256,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartients');
    }
};
