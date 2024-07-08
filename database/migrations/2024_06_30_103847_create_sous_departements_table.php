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
        Schema::create('sous_departements', function (Blueprint $table) {
            $table->integer('id_sous_depart')->primary()->autoIncrement();
            $table->integer('id_depart');
            $table->foreign('id_depart')->references('id_depart')->on('departements');
            $table->string('Nom_sous_depart')->unique();
            $table->string('Descriptif_sous_depart')->unique();
            $table->string('Nom_sous_depart_ar')->unique();
            $table->string('Descriptif_sous_depart_ar')->unique();

        });

        DB::table('sous_departements')->insert([
            [
                'id_sous_depart' => 10,
                'id_depart' => 2,
                'Nom_sous_depart' => 'prsonnl',
                'Descriptif_sous_depart' => 'psnll',
                'Nom_sous_depart_ar' => 'المستخدمين',
                'Descriptif_sous_depart_ar' => 'المستخدمين',
                
            ], 
            [
                'id_sous_depart' => 15,
                'id_depart' => 1,
                'Nom_sous_depart' => 'dev',
                'Descriptif_sous_depart' => 'dev',
                'Nom_sous_depart_ar' => 'تطوير',
                'Descriptif_sous_depart_ar' => 'تطوير',
            ],
        ]);
               
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_departements');
    }
};
