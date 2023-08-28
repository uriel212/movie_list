<?php

namespace App\Livewire;

use App\Models\MoviesSeries;
use App\Models\Ratings;
use App\Models\UserMoviesSeries;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MovieModal extends Component
{

    public $movieId;
    public $movieData;

    // protected $listeners = ['modalOpened' => 'updateMovieId'];


    public function mount($movieId)
    {
        $this->movieId = $movieId;
        $params = [
            'apikey' => '6d9ef4eb',
            'i' => $this->movieId
        ];

        $queryString = http_build_query(array_filter($params));
        $url = "http://www.omdbapi.com/?" . $queryString;

        $response = Http::get($url);
        $this->movieData = $response->json();
        
    }

    public function addToMyList()
    {
        if ($this->movieData) {
            //verify if the movie already exists in the database
            $movie_serie = MoviesSeries::where('imdb_id', $this->movieData['imdbID'])->first();

            //Create the movie if it doesn't exist
            if (!$movie_serie) {
                $movie_serie = MoviesSeries::create([
                    'imdb_id' => $this->movieData['imdbID'],
                    'title' => $this->movieData['Title'],
                    'year' => $this->movieData['Year'],
                    'image' => $this->movieData['Poster'],
                    'type' => $this->movieData['Type']
                ]);
            }

            $ratings = $this->movieData['Ratings'];

            foreach ($ratings as $rating) {
                Ratings::create([
                    'movie_serie_id' => $movie_serie->id,
                    'source' => $rating['Source'],
                    'value' => $rating['Value']
                ]);
            }

            //First we verify if the user has the movie on his list
            $userMovieSerie = UserMoviesSeries::where('user_id', auth()->user()->id)
                ->where('movie_serie_id', $movie_serie->id)
                ->first();
            //Adding the movie to the user's list if it doesn't exist
            if (!$userMovieSerie) {
                UserMoviesSeries::create([
                    'user_id' => auth()->user()->id,
                    'movie_serie_id' => $movie_serie->id
                ]);
            }

            // Reset the fetched API data
            $this->movieData = null;

            // Emit a success message
            // $this->emit('movieAdded', 'Movie added to your list.');
            // Session::flash('movieAdded', 'Movie added to your list.');
        }
    }

    public function closeModal()
    {
        $this->movieData  = null;
        $this->movieId = null;
    }

    public function render()
    {
        return view('livewire.movie-modal');
    }
}
