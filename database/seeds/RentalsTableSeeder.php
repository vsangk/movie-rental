<?php

use Illuminate\Database\Seeder;

class RentalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::first();
        // todo: make this better lol
        $inventory_ids = array_map(
            function ($val) { return $val + 1; },
            array_slice(
                App\Inventory::all()->pluck('film_id')->unique()->keys()->toArray(),
                0,
                4
            )
        );
        // (janet) Do I need to be handling this date manually?
        $user->rentals()->attach($inventory_ids, [
            'rental_date' => \Carbon\Carbon::now()->toDateTimeString(),
            'return_date' => \Carbon\Carbon::now()->addDays(7)->toDateTimeString(),
        ]);
    }
}
