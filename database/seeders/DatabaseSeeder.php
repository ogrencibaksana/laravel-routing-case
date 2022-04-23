<?php

namespace Database\Seeders;

use App\Models\Art;
use App\Models\Artist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        Artist::factory(50)->create()->each(function ($artist) {
            $artist->art()->saveMany(Art::factory(rand(1, 75))->create(['artist_id' => $artist->id]));
        });
    }
}
