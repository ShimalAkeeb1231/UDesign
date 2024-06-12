<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class PUpdatingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_can_be_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Old Name',
            'price' => 100,
            'description' => 'Old description.',
            'category_id' => $category->id
        ]);

        $response = $this->put('/products/' . $product->id, [
            'name' => 'New Name',
            'price' => 150,
            'description' => 'New description.',
            'category_id' => $category->id
        ]);

        $response->assertStatus(200);  // Expected status 200
        $this->assertEquals('New Name', $product->fresh()->name);  // Expected 'New Name'
    }
}





