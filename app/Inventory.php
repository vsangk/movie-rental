<?php

namespace App;

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
        return $this->belongsToMany(Inventory::class, 'rentals')
            ->as('rentals')
            ->withTimestamps();
    }
}
