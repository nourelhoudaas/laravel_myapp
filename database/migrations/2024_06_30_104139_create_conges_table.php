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
        Schema::create('conges', function (Blueprint $table) {
            $table->string('id_cong')->primary();
            $table->date('date_debut_cong');
            $table->date('date_fin_cong');
            $table->string('ref_cong')->unique();
            $table->integer('id_nin')->unique();
            $table->integer('id_p')->unique();
            $table->foreign('id_nin')->references('id_nin')->on('Employe');
            $table->foreign('id_p')->references('id_p')->on('Employe');
            $table->foreign('ref_cong')->references('ref_cong')->on('Type_cong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
