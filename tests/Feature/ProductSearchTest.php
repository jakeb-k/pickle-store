<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function basic_match_test()
    {
        $product = Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'paddle'
        ]);
        $response = $this->get('/search?query=paddle');
        $response->assertSee($product->name);
    }

    /** @test */
    public function case_insensitivity_test()
    {
        $product = Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'Paddle'
        ]);
        $response = $this->get('/search?query=paddle');
        $response->assertSee($product->name);
    }

    /** @test */
    public function partial_match_test()
    {
        $product = Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'paddle'
        ]);
        $response = $this->get('/search?query=pad');
        $response->assertSee($product->name);
    }

    /** @test */
    public function no_match_test()
    {
        Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'paddle'
        ]);
        $response = $this->get('/search?query=banana');
        $response->assertDontSee('paddle');
    }

    /** @test */
    public function multiple_matches_test()
    {
        $paddleProduct = Product::create([
            'name' => 'Mens Paddle',
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'mens,paddle'
        ]);
        $clothingProduct = Product::create([
            'name' => 'Mens Hat',
            'url' => 'another-url',
            'type' => 'another-type',
            'delivery' => 6,
            'price' => 20.00,
            'available' => true,
            'tags' => 'mens,clothing'
        ]);
        $response = $this->get('/search?query=Mens');
        $response->assertSee($paddleProduct->name)
                 ->assertSee($clothingProduct->name);
    }

    /** @test */
    public function special_characters_handling()
    {
        $product = Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => "Men's"
        ]);
        $response = $this->get("/search?query=Men's");
        $response->assertSee($product->name);
    }

    /** @test */
    public function whitespace_handling()
    {
        $product = Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'paddle'
        ]);
        $response = $this->get('/search?query=  paddle  ');
        $response->assertSee($product->name);
    }

    /** @test */
    public function empty_query_test()
    {
        $product = Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'paddle'
        ]);
        $response = $this->get('/search?query=');
        $response->assertDontSee($product->name);
    }

    /** @test */
    public function sql_injection_safety_test()
    {
        $product = Product::create([
            'name' => $this->faker->unique()->name,
            'url' => 'test-url',
            'type' => 'test-type',
            'delivery' => 5,
            'price' => 10.00,
            'available' => true,
            'tags' => 'paddle'
        ]);
        $maliciousQuery = "'; DROP TABLE products;--";
        $response = $this->get("/search?query=$maliciousQuery");
        $response->assertDontSee($product->name);
    }

    /** @test */
    public function performance_test()
    {
        // Seed the database with a large number of products to test performance.
        Product::factory()->count(10000)->create(['tags' => 'paddle']);
        $start = microtime(true);
        $response = $this->get('/search?query=paddle');
        $end = microtime(true);
        $this->assertTrue(($end - $start) < 2); // Expect the search to take less than 2 seconds.
    }
}
