<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'post_id' => $this->faker->numberBetween(1, 200),
            'report_id' => $this->faker->randomElement(
                [NULL, NULL, NULL, NULL, NULL, NULL, 10, 11]
            ),

            'body' => $this->faker->sentence(),
        ];
    }
}
