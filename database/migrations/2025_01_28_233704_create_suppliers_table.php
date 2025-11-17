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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('payment_type');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $suppliers = [
            [
                'name' => 'Abacus Pharmacuticals',
                'phone' => '0705552385',
                'address' => 'William Street',
                'payment_type' => 'Credit',
            ],
            [
                'name' => 'Kam Care',
                'phone' => '077414457',
                'address' => 'William Street',
                'payment_type' => 'Cash',
            ],
            [
                'name' => 'Krypton',
                'phone' => '0705552385',
                'address' => 'Salama Road',
                'payment_type' => 'Cash',
            ],
        ];
        foreach ($suppliers as $supplier) {
            DB::table('suppliers')->insert([
                'name' => $supplier['name'],
                'email' => $supplier['email'] ?? null,
                'phone' => $supplier['phone'],
                'address' => $supplier['address'],
                'payment_type' => $supplier['payment_type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
