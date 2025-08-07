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
        Schema::create('filieres', function (Blueprint $table) {
            $table->integer('id_filiere')->primary()->autoIncrement();
            $table->string('Nom_filiere');
            $table->string('Nom_filiere_ar');
        });

        DB::table('filieres')->insert([
            [
                
                'Nom_filiere' => 'informatique',
                'Nom_filiere_ar' => 'الاعلام الالي',
             


            ],
            [
                
                'Nom_filiere' => 'statistique',
                'Nom_filiere_ar' => 'الاحصاء',
             


            ],
            

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filieres');
    }
};
