<?php

namespace Database\Factories;

use App\Models\Shelf;
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
        $categories = ['sport', 'history', 'novels', 'science'];
        $shelfIds = Shelf::pluck('id')->toArray();

        return [
            'isbn' => $this->faker->isbn13,
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'year' => $this->faker->numberBetween(1900, date('Y')),
            'category' => $this->faker->randomElement($categories),
            'pdf_path' => 'public/pdfs/YASSER_ELHASAN_CV.pdf',
            'image' => 'public/images/zpecayEtxaArlT8Tyzr7FRD4WTGLExLYtPcV7MfA.jpg',
            'count' => $this->faker->numberBetween(1, 5),
            'shelf_id' => $this->faker->randomElement($shelfIds),
        ];
    }
}
