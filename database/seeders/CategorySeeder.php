<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Category;

// Helpers
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category::truncate(); -> funzione per svuotare la tabella
        
        $categories = [
            'Guide',
            'Gameplay',
            'News',
            'Recensioni',
            'Eventi',
            'Off Topic',
            'Leak',
            'Offerte',
            'Soluzioni',
            'Cracked',
            'Cosplay'
        ];

        foreach ($categories as $category) {
            $newCategory = Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
