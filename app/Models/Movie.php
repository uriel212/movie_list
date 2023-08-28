<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = ['imdb_id','title', 'year', 'image'];

    public function ratings()
    {
        return $this->hasMany(MovieRatings::class);
    }
}
