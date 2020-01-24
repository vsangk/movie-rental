<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

//    protected $fillable = [
//        'film_id',
//        'rating',
//        'comment'
//    ];

    public function film() {
        return $this->belongsTo(Film::class);
    }
}
