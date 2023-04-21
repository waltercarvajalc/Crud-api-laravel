<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /// Vaciamos la tabla categories
        Category::truncate();
        $faker = Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Category::create([
                'name' => $faker->word,
                'description' => $faker->paragraph
            ]);
        }
    }
}
