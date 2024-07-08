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
        Schema::create('departements', function (Blueprint $table) {
            $table->integer('id_depart')->primary()->autoIncrement();
            $table->string('Nom_depart')->unique();
            $table->string('Descriptif_depart')->unique();
            $table->string('Nom_depart_ar')->unique();
            $table->string('Descriptif_depart_ar')->unique();

        });
        DB::table('departements')->insert([
            [
                'id_depart' => 1,
                'Nom_depart' => 'developpement',
                'Descriptif_depart' => 'developpement',
                'Nom_depart_ar' => 'تطوير',
                'Descriptif_depart_ar' => 'تطوير',
               
            ], 
            [
                'id_depart' => 2,
                'Nom_depart' => 'personnel',
                'Descriptif_depart' => 'personnel',
                'Nom_depart_ar' => 'ادارة-المستخدمين',
                'Descriptif_depart_ar' => 'ادارة-المستخدمين',
            ]
               
            ]);
    }



    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
    }
};
