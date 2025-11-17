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
        Schema::create('expense_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('frequency')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('owner_expense')->default(true);
            $table->timestamps();
        });
        
        DB::table('expense_types')->insert(
            array(
                [
                    'name'  => 'Administartion',
                    'status' => true,
                    'owner_expense' => false,
                    'description' => 'Administartion related expenses',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Payments',
                    'status' => 1,
                    'owner_expense' => true,
                    'description' => 'Payments to suppliers after delivering medicines',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Repairs and Maintenance',
                    'status' => true,
                    'owner_expense' => false,
                    'description' => 'Repairs and Maintenance of Pharmacy Equipment',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Software Subscriptions',
                    'status' => true,
                    'owner_expense' => false,
                    'description' => 'Software Subscriptions',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'PAYE',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Pay As You Earn Tax',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'NSSF',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'National Social Security Fund Contributions',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'URSB Returns',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Returns to Uganda Registration Services Bureau',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'URA Returns',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Returns to Uganda Revenue Authority',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Pharmacy Operating License',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Licence fees to operate a pharmacy',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Certificate of suitability of Premises',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Certificate of suitability of Premises',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Salaries',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Salaries of staff',
                    'created_at' => now(),
                    
                ],
                [
                    'name'  => 'Rent',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Rent for the pharmacy premises',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Utilities',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Utilities like water and electricity',
                    'created_at' => now(),
                ],
                [
                    'name'  => 'Insurance',
                    'status' => true,
                    'owner_expense' => true,
                    'description' => 'Insurance of the pharmacy',
                    'created_at' => now(),
                ])
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_types');
    }
};
