<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // fill movies table
        DB::table('movies')->insert([
            'title' => 'The Shawshank Redemption',
            'description' => 'Movie by Frank Darabont',
            'age_rating'   => 'PG-13',
            'language' => 'HU',
            'cover_image' => 'https://www.imdb.com/title/tt0111161/mediaviewer/rm2488434432/',
        ]);

        DB::table('movies')->insert([
            'title' => 'The Godfather',
            'description' => 'Movie by Francis Ford Coppola',
            'age_rating'   => 'PG-13',
            'language' => 'HU',
            'cover_image' => 'https://www.imdb.com/title/tt0068646/mediaviewer/rm2488434432/',
        ]);

        DB::table('movies')->insert([
            'title' => 'The Dark Knight',
            'description' => 'Movie by Christopher Nolan',
            'age_rating'   => 'PG-13',
            'language' => 'HU',
            'cover_image' => 'https://www.imdb.com/title/tt0468569/mediaviewer/rm2488434432/',
        ]);

        for ($i = 0; $i < 20; $i++) {
            DB::table('schedules')->insert([
                'movie_id' => rand(1, 3),
                'date' => date('Y-m-d', strtotime('+' . rand(1, 10) . ' day')),
                'time' => rand(16, 22) . ':00:00',
                'available_seats' => rand(10, 100)
            ]);
        }
    }
}
