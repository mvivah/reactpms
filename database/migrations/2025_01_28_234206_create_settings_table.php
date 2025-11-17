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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('app_name');
            $table->string('company_phone');
            $table->string('currency_name');
            $table->string('currency_code');
            $table->string('from_email');
            $table->string('from_name');
            $table->string('company_address');
            $table->integer('profit_percentage')->default(50);
            $table->integer('shelf_life')->default(180);
            $table->integer('credit_period')->default(60);
            $table->timestamps();
        });

        DB::table('settings')->insert([
            'from_email' => 'owner@avante.com',
            'from_name' => 'Pharmacy Owner',
            'shelf_life' => 180,
            'credit_period' => 60,
            'currency_name' => 'Uganda Shilling',
            'currency_code' => 'UGX',
            'company_name' => 'Avante Pharmacy',
            'app_name' => 'AvantePMS',
            'company_phone' => '07123456789',
            'company_address' => 'Company Address',
            'profit_percentage' => 50,
            'created_at'=> now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
