<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoviesSeries extends Model
{
    use HasFactory;
    
    protected $fillable = ['imdb_id','title', 'year', 'image', 'type'];

    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'movie_serie_id');
    }
}
