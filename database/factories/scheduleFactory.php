<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\schedule>
 */
class scheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $movieIDs = \App\Models\Movie::pluck('id')->toArray();
        $date = $this->faker->dateTimeBetween('now', '+1 month');
        $time = str_pad(rand(12,22), 2, '0', STR_PAD_LEFT) . ':00:00';
        return [
            'movie_id' => $this->faker->randomElement($movieIDs),
            'date' => $date->format('Y-m-d'),
            'time' => $time,
            'available_seats' => rand(10, 100)
        ];
    }
}
