<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Review::class, 4)->create([
            'film_id' => 1,
        ]);
        factory(App\Review::class, 5)->create([
            'film_id' => 2,
        ]);
    }
}
