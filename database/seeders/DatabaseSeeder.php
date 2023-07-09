<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Shelf;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $shelfIds = Shelf::pluck('id')->toArray();

        Book::factory()
            ->count(10)
            ->afterCreating(function (Book $book) use ($shelfIds) {
                $shelf = Shelf::find($book->shelf_id);
                if ($shelf) {
                    $shelf->occupied_count += $book->count;
                    $shelf->save();
                }
            })
            ->create();

    }
}
