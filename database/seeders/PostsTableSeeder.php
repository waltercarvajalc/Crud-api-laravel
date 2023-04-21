<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla posts.
        Post::truncate();
        $faker = \Faker\Factory::create();

        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear posts en su nombre
        $users = \App\Models\User::all();
       

        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '12345678']);

            // Y ahora con este usuario creamos algunos posts
            $num_posts = 5;
            for ($j = 0; $j < $num_posts; $j++) {
                Post::create([
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'status' => $faker->randomElement(['Published', 'Not published']),
                    'content' => $faker->paragraph,
                    'category_id' => $faker->numberBetween(1, 3)
                    
                    
                ]);
            }
        }
    }
}
