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
        if (!Schema::hasColumn('purchases', 'payment_type')) {
            Schema::table('purchases', function (Blueprint $table) {
                $table->string('payment_type', 10)->default('Cash')->after('payment_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('purchases', 'payment_type')) {
            Schema::table('purchases', function (Blueprint $table) {
                $table->dropColumn('payment_type');
            });
        }
    }
};
