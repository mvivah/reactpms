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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('receipt_id')->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('purchase_id')->nullable();
            $table->string('batch_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('received_quantity')->default(0);
            $table->integer('available_quantity')->default(0);
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('unit_purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->decimal('unit_selling_price', 10, 2);
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('updated_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
