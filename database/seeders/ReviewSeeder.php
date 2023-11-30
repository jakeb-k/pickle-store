<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; 
use App\Models\Review; 

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
         $products->each(function ($product) {
            Review::factory()->count(rand(3, 4))->create(['product_id' => $product->id]);
        });
    }
}
