<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\movieFactory;
use Database\Factories\scheduleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new movieFactory())->count(5)->create();
        (new scheduleFactory())->count(20)->create();
    }
}
