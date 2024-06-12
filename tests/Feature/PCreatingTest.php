<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class PCreatingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();

        $response = $this->post('/products', [
            'name' => 'Test Product',
            'price' => 100,
            'description' => 'This is a test product.',
            'category_id' => $category->id
        ]);

        $response->assertStatus(201);  // Expected status 201
        $this->assertCount(1, Product::all());  // Expected count 1
    }
}





