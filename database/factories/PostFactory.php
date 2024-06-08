<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 12),
            'category_id' => $this->faker->numberBetween(1, 30),
            'report_id' => $this->faker->randomElement(
                [NULL, NULL, NULL, NULL, NULL, NULL, 8, 11, 12]
            ),

            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'view' => $this->faker->numberBetween(0, 1000),
            'status' => $this->faker->randomElement(['draft', 'published', 'published', 'published', 'published', 'published']),
        ];
    }
}
