<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Rental extends Pivot
{
    protected $table = 'rentals';

    // (janet) will this cause problems?
    protected $casts = [
        'rental_date' => 'datetime',
        'return_date' => 'datetime'
    ];
}
