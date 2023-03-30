<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Tag;

// Helpers
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tag::truncate(); -> funzione per svuotare la tabella
        
        $tags = [
            'PS5',
            'Mobile',
            'PC',
            'Xbox',
            'Nintendo',
            'Multigiocatore',
            'Single player',
            'Fps',
            'RPG',
            'Free To Play',
            'Open World'
        ];

        foreach ($tags as $tag) {
            $newTag = Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ]);
        }
    }
}
