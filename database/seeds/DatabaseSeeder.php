<?php

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
         $this->call([
             UsersTableSeeder::class,
             FilmsTableSeeder::class,
             InventoriesTableSeeder::class,
             RentalsTableSeeder::class,
             ReviewSeeder::class,
         ]);
    }
}
