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
        Schema::create('fonctions', function (Blueprint $table) {
            $table->string('id_fonction')->primary();
            $table->string('Nom_fonction');
            $table->string('Nom_fonction_ar');
            $table->float('Moyenne');
        
        });

        DB::table('fonctions')->insert([
            [
                'id_fonction' => '3bm',
                'Nom_fonction' => 'Directeur',
                'Nom_fonction_ar' => 'مدير',
                'Moyenne' => 1628,
                
              

            ],
            [
                'id_fonction' => 'b3m-1',
                'Nom_fonction' => 'Sous-directeur',
                'Nom_fonction_ar' => 'مدير فرعي',
                'Moyenne' => 1528,
            ]

            ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonctions');
    }
};
