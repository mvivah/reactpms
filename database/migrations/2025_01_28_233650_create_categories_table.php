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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        $categories = [
            'Antibiotics',
            'Antifungal',
            'Antidiabetic',
            'Antitussives',
            'Antistamines',
            'Antihelmetics',
            'Anti Hypertensives',
            'Analgesics',
            'Antihelmentics',
            'Antihelmintics',
            'Anti Colic',
            'Anti Allergy',
            'Antibiotics_Steroids',
            'Anti Wax',
            'Homonals',
            'Sundries',
            'Cosmetics',
            'Colic Pain',
            'Antiviral',
            'Anti Acid',
            'Anti Emetics',
            'Antihypertensive',
            'Antihaemorrhoidal',
            'Antipsychotic',
            'Anti Ulcer',
            'Anti Tusives',
            'Antimalarial',
            'Antidiabetics',
            'Antihistamines',
            'Anthelmintics',
            'Body Care',
            'Baby Care',
            'Baby Formula',
            'Bronchodilators',
            'Expectorants',
            'Inhalers',
            'Hormonals',
            'Laxatives',
            'Mucolytics',
            'Anti Malarials',
            'Antiulcer',
            'Moisturisers',
            'Anti Puretics',
            'Anti Histamines',
            'Eardrops',
            'Probiotics',
            'Herbals',
            'Sulfonamides',
            'Nasal Decongestants',
            'Antibiotics_Antifungal_Steroids',
            'Antihistamines_Cough',
            'Lubricants',
            'Oral Health',
            'Oral Care',
            'Lozenges',
            'Antemetics',
            'Diagnostics',
            'Fluids',
            'Antiacids',
            'Manpower',
            'Decongestant',
            'Sedatives',
            'Supplements', 
            'Suppositories',
            'Injectables',
            'Contraceptives',
            'Condoms',
            'Pessaries',
            'Steroids',
            'Anti Psychotics',
            'Vaccines',
            'Wound Care',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                
                'name' => $category,
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
        Schema::dropIfExists('categories');
    }
};
