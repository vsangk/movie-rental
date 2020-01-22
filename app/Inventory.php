<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;

    protected $fillable = ['film_id'];

    public function film() {
        return $this->belongsTo(Film::class);
    }

    public function rentals() {
        return $this->belongsToMany(User::class, 'rentals')
            ->using(Rental::class)
            ->withPivot('rental_date', 'return_date');
    }

    public function activeRental() {
        $latestRental = $this->rentals->pluck('pivot')->sortBy('rental_date')->first();

        if ($latestRental && $latestRental->return_date < Carbon::now()->toDateString()) {
            return $latestRental;
        }

        return null;
    }
}
