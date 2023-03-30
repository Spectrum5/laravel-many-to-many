<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Post;
use App\Models\Category;

// Helpers
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) {
            $title =$faker->unique()->sentence(4); // Crea frasi da più o meno 4 parole

            $categoryId = null;
            // if (rand(0, 1) == 1) {
            if (rand(0,1)) {
                $categoryId = Category::inRandomOrder()->first()->id;
            }

            Post::create([
                'title' => $faker->sentence(4),
                'slug' => Str::slug($title),
                'content' => $faker->paragraph(),
                'category_id' => $categoryId
            ]);
        }
    }
}
