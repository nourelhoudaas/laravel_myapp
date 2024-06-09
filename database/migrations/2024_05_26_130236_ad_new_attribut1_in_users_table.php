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
        Schema::table('users', function (Blueprint $table) {
            //ici on a rajouter des attributs dans la table users pour la verification de l email dans la creation d un nouveau compte
            $table->integer('is_verified')
                    ->default(0);

            $table->string('activation_code', 255)
                    ->nullable();

            $table->string('activation_token', 255)
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //


        });
    }
};
