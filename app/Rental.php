<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Rental extends Pivot
{
    protected $table = 'rentals';
}
