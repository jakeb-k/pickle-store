<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Review::class;

    

    public function definition()
    {
        $startDate = Carbon::now()->subDays(365); // Set the start date (365 days ago)
        $endDate = Carbon::now(); // Set the end date (today)

        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'rating' => $this->faker->numberBetween(3, 5),
            'content' => "", 
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate),
            'updated_at' => $this->faker->dateTimeBetween($startDate, $endDate),
            // Add other review fields as needed
        ];
    }
}
