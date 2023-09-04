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
            return UserMoviesSeries::where('user_id', auth()->user()->id)
            ->with('user', 'movie_serie.ratings')
            ->get();
        } else {
            return UserMoviesSeries::where('user_id', auth()->user()->id)
            ->with('user', 'movie_serie.ratings')
            ->whereHas('movie_serie', function ($query) {
                $query->where('type', $this->filter);
            })
            ->get();
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
        $movies = $this->getSeriesOrMovies();
        return view('livewire.user-movies-list', ['movies' => $movies]);
    }
}
