<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    protected $fillable = ['movie_serie_id', 'source', 'value'];

    // Define the relationship with the Movie model
    public function movie_serie()
    {
        return $this->belongsTo(MoviesSeries::class);
    }
}
