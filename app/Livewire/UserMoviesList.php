<?php

namespace App\Livewire;

use App\Models\UserMoviesSeries;
use Livewire\Component;

class UserMoviesList extends Component
{
    public $filter = '';

    public function applyFilter($type)
    {
        $this->filter = $type;
    }

    public function getSeriesOrMovies() 
    {
        if ($this->filter == '') {
            return UserMoviesSeries::with('user', 'movie_serie.ratings')->get();
        } else {
            return UserMoviesSeries::with('user', 'movie_serie.ratings')->whereHas('movie_serie', function ($query) {
                $query->where('type', $this->filter);
            })->get();
        }
    }

    public function softDeleteMovie($movieId)
    {
        $userMovie = UserMoviesSeries::find($movieId);
        if ($userMovie) {
            $userMovie->delete();
        }
    }

    public function render()
    {
        $movies = UserMoviesSeries::with('user', 'movie_serie.ratings')->get();
        return view('livewire.user-movies-list', ['movies' => $movies]);
    }
}
