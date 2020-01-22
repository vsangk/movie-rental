<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'release_year', 'length'
    ];

    public function inventories() {
        return $this->hasMany(Inventory::class);
    }

    public function addInventory($amount = 1) {
        // (janet) better way to do this?
        return $this->inventories()->saveMany(array_map(
            function () {
                return new Inventory();
            },
            range(1, $amount)
        ));
    }

    public function rentals() {
        return $this->hasManyThrough(Rental::class, Inventory::class);
    }

    public function availableRentals() {
        // TODO: clean up this horrible horrible mess
        $inventoryWithRentals = $this->inventories()->with('rentals')->get();

        return $inventoryWithRentals
            ->map(function($inv) {
                if ($inv->rentals->isEmpty()) {
                    return $inv;
                }

                $latest_rental = $inv->rentals->pluck('pivot')->sortByDesc('rental_date')->first();

                if ($latest_rental->return_date < Carbon::now()->toDateString()) {
                    return $inv;
                } else {
                    return null;
                }
            })
            ->filter(function($i) { return !!$i; });
    }
}
