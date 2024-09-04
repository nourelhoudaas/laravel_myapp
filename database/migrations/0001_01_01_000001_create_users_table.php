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
        Schema::create('users', function (Blueprint $table) {
            //$table->id();
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->integer('id_nin');
            $table->foreign('id_nin')->references('id_nin')->on('employes');
            $table->integer('id_p')->unique();
            $table->foreign('id_p')->references('id_p')->on('employes');
            $table->string('username')->unique();
            //$table->string('email')->unique();
           // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //$table->rememberToken();
            $table->timestamps();
            $table->timestamp('password_changed_at')->nullable();
            $table->timestamp('password_created_at')->nullable();
            $table->string('nv_password')->nullable(); 
            $table->integer('nbr_login');
            

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('username')->primary();
            //$table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        DB::table('users')->insert([
            [  
            
                'name' => 'fadia',
                'id_nin' => 1254953,
                'id_p' => 123,
                'username' => 'fadia',
                'password' => '$2y$12$QMNdYb8dQXCgpdWM9NF4OebBiHPAyKplRHoDqJFmqQnSXd9cCg1SW',
                'nbr_login' => 0,
            ],
        ]);
    
    }

  
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
