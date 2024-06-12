<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class PDeletingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100,
            'description' => 'This is a test product.',
            'category_id' => $category->id
        ]);

        $response = $this->delete('/products/' . $product->id);

        $response->assertStatus(200);  // Expected status 200
        $this->assertCount(0, Product::all());  // Expected count 0
    }
}



