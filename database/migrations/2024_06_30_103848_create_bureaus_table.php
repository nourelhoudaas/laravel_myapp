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
        Schema::create('bureaus', function (Blueprint $table) {
            $table->integer('id_bureau')->primary()->autoIncrement();
            $table->integer('Num_bureau');
        
        });
        DB::table('bureaus')->insert([
            [
                'id_bureau' => 5,
                'Num_bureau' => 203,
            ]

               
            ]);
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bureaus');
    }
};
