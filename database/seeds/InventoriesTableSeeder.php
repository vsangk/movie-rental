<?php

use Illuminate\Database\Seeder;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $films = App\Film::all();
        factory(App\Inventory::class, 5)->create([
            'film_id' => $films[0]->id
        ]);
        factory(App\Inventory::class, 3)->create([
            'film_id' => $films[1]->id
        ]);
        factory(App\Inventory::class, 4)->create([
            'film_id' => $films[2]->id
        ]);
    }
}
