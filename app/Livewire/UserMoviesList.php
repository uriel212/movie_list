<?php

namespace App\Livewire;

use App\Models\UserMovies;
use Livewire\Component;

class UserMoviesList extends Component
{

    public $movies;

    public function mount()
    {
        // Fetch movies from the database
        $this->movies = UserMovies::with('user', 'movie.ratings')->get();
    }

    public function render()
    {
        return view('livewire.user-movies-list');
    }
}
