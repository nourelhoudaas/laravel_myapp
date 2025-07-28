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
            $table->integer('id_log')->primary()->autoIncrement();
            $table->DateTime('date_login');
            $table->DateTime('date_logout')->nullable();
            $table->integer('id_nin');
            $table->integer('id_p');
            $table->integer('id');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->foreign('id')->references('id')->on('users');

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
