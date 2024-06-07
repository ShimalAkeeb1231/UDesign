<?php

namespace Database\Factories;

use App\Models\Category; // Import the Category model
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random category ID from the existing categories
        $category_id = Category::inRandomOrder()->value('id');

        return [
            // 'name' => $this->faker->word(), // Use word instead of name for product names
            // 'description' => $this->faker->sentence(10), // Use sentence for more natural text
            // 'price' => $this->faker->randomFloat(2, 1, 1000),
            // 'category_id' => $category_id, // Assign the random category ID
            
            
        ];
    }
}
