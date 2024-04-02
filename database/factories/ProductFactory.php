<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
   /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence.$this->faker->numberBetween(1, 10000),
            'url' => $this->faker->url,
            'type' => $this->faker->word,
            'delivery' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'discount' => $this->faker->randomFloat(2, 1, 100) ?: null,
            'sku' => $this->faker->uuid ?: null,
            'description' => $this->faker->sentence ?: null,
            'image' => $this->faker->imageUrl() ?: null,
            'tags' => $this->faker->word,
            'rating' => $this->faker->randomFloat(1, 1, 5) ?: null,
            'available' => $this->faker->boolean,
            'options' => $this->faker->sentence ?: null,
        ];
    }
}
