<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class PListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_products_can_be_listed()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100,
            'description' => 'This is a test product.',
            'category_id' => $category->id
        ]);

        $response = $this->get('/products');

        $response->assertStatus(200);  // Expected status 200
        $response->assertJsonCount(1);  // Expected one product in response
    }
}



