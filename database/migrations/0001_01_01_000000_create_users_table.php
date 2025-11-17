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
            $table->id();
            $table->string('staff_id')->unique()->nullable();
            $table->string('firstname');
			$table->string('lastname');
			$table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone_number')->nullable();
			$table->foreignId('role_id');
			$table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
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
        //insert default user
        DB::table('users')->insert(
            array([
            'staff_id' => '00000001',
            'firstname' => 'Owner',
            'lastname' => 'Account',
            'email' => 'owner@avante.com',
            'password' => bcrypt('m!p@ssW0rd'),
            'role_id' => 1,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ],[
            'staff_id' => '00000002',
            'firstname' => 'Cashier',
            'lastname' => 'Account',
            'email' => 'cashier@avante.com',
            'password' => bcrypt('m!p@ssW0rd'),
            'role_id' => 2,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ])
        );
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
