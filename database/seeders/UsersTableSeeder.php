<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();

        $faker = \Faker\Factory::create();

        DB::table('users')->insert([
            'name' => 'AdminUno',
            'email' => 'adminuno@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'ROLE_ADMIN'
            ]);
        
    }
}
