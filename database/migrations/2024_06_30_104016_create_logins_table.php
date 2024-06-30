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
        Schema::create('logins', function (Blueprint $table) {
            $table->string('id_log')->primary();
            $table->timestamp('date_login');
            $table->timestamps('date_logout')->nullable();
            $table->integer('id_nin')->unique();
            $table->integer('id_p')->unique();
            $table->foreign('id_nin')->references('id_nin')->on('Employe');
            $table->foreign('id_p')->references('id_p')->on('Employe');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logins');
    }
};
