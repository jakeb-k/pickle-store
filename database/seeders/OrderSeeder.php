<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            'products' => '1,yoga_mat2,2,door_mat1',
            'total' => 29.67,
            'user_id'=>1,
            'sent' => false,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('orders')->insert([
            'products' => '1,yoga_mat3,2,car_mat1,1,door_mat2',
            'total' => 57.16,
            'user_id'=>2,
            'sent' => false,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('orders')->insert([
            'products' => '1,car_mat2,1,yoga_mat1',
            'total' => 32.98,
            'user_id'=>3,
            'sent' => false,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('orders')->insert([
            'products' => '1,car_mat3,3,door_mat2,2,yoga_mat3',
            'total' => 72.53,
            'user_id'=>3,
            'sent' => false,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
