<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMoviesSeries extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movie_serie_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie_serie()
    {
        return $this->belongsTo(MoviesSeries::class)->with('ratings');
    }
}
