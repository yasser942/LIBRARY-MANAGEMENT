<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['sport', 'history', 'novels' ,'science'];
        return [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'year' => $this->faker->numberBetween(1900, date('Y')),
            'category' => $this->faker->randomElement($categories),
        ];
    }
}
