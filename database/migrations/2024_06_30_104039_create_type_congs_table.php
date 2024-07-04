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
        Schema::create('type_congs', function (Blueprint $table) {
            $table->string('ref_cong')->primary()->autoIncrement();
            $table->string('titre_cong');
            $table->string('Descriptif');
            $table->string('titre_cong_ar');
            $table->string('Descriptif_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_congs');
    }
};
