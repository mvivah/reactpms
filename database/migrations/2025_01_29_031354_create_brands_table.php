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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();  
            $table->timestamps();
        });

        $brands = [
            'Johnson & Johnson', 'Procter & Gamble', 'Unilever', 'Colgate-Palmolive', 
            'Reckitt Benckiser', 'GlaxoSmithKline', 'Novartis', 'Abbott Laboratories', 
            'Pfizer', 'Bayer', 'Merck', 'Church & Dwight', 'Clorox', 
            'SC Johnson', 'Estee Lauder', 'Revlon', 'L\'Oreal', 'Shiseido', 
            'Beiersdorf', 'Avon Products', 'Amway', 'Herbalife', 'Oriflame', 
            'Forever Living Products', 'Arbonne International', 'The Body Shop'
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
