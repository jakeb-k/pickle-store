<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(23)->create();

        DB::table('users')->insert([
            'name' => "Jakey",
            'email' => 'j@j.com',
            'role'=>1,
            'street'=>'789 Placemat Parade',
            'city'=>'Gold Coast',
            'state'=>'QLD',
            'postcode'=>4232,
            'favs'=>'4,5,8',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => 'admin@mats.com',
            'role'=>0,
            'street'=>'23 Admin Road',
            'city'=>'Wilton',
            'state'=>'NSW',
            'postcode'=>2571,
            'favs'=>'4,5,8',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => "Bob",
            'email' => 'Bob@gmail.com',
            'street'=>'123 Mat Street',
            'city'=>'Perth',
            'state'=>'TAS',
            'postcode'=>7300,
            'role'=>1,
            'favs'=>'1',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => "Fred",
            'email' => 'Fred@gmail.com',
            'street'=>'456 Carpet Crescent',
            'city'=>'Kwinana',
            'state'=>'WA',
            'postcode'=>6717,
            'role'=>1,
            'favs'=>'3',
            'password' => bcrypt('123456'),
        ]);
    }
}
