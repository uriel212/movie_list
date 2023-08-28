<?php

namespace App\Livewire;

use App\Models\Movie;
use App\Models\MovieRatings;
use App\Models\UserMovies;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Movies extends Component
{
    public $imdbId;
    public $title;
    public $type;
    public $page;
    public $year;
    public $apiData;

    public function fetchApiData()
    {
        $params = [
            'apikey' => '6d9ef4eb',
            's' => $this->title,
            'type' => $this->type,
            'y' => $this->year,
            'page' => $this->page
        ];

        $queryString = http_build_query(array_filter($params));
        $url = "http://www.omdbapi.com/?" . $queryString;

        $response = Http::get($url);
        $this->apiData = $response->json();
    }

    public function getMovieData () {
        $params = [
            'apikey' => '6d9ef4eb',
            'i' => $this->imdbId
        ];

        $queryString = http_build_query(array_filter($params));
        $url = "http://www.omdbapi.com/?" . $queryString;

        $response = Http::get($url);
        $this->apiData = $response->json();
    }

    public function addToMyList()
    {
        if ($this->apiData) {
            //verify if the movie already exists in the database
            $movie = Movie::where('imdb_id', $this->apiData['imdbID'])->first();

            //Create the movie if it doesn't exist
            if (!$movie) {
                $movie = Movie::create([
                    'imdb_id' => $this->apiData['imdbID'],
                    'title' => $this->apiData['Title'],
                    'year' => $this->apiData['Year'],
                    'image' => $this->apiData['Poster']
                ]);
            }

            $ratings = $this->apiData['Ratings'];

            foreach($ratings as $rating){
                MovieRatings::create([
                    'movie_id' => $movie->id,
                    'source' => $rating['Source'],
                    'value' => $rating['Value']
                ]);
            }

            //First we verify if the user has the movie on his list
            $userMovie = UserMovies::where('user_id', auth()->user()->id)
                ->where('movie_id', $movie->id)
                ->first();
            //Adding the movie to the user's list if it doesn't exist
            if(!$userMovie){
                UserMovies::create([
                    'user_id' => auth()->user()->id,
                    'movie_id' => $movie->id
                ]);
            }

            // Reset the fetched API data
            $this->apiData = null;

            // Emit a success message
            // $this->emit('movieAdded', 'Movie added to your list.');
            // Session::flash('movieAdded', 'Movie added to your list.');
        }
    }

    public function render()
    {
        return view('livewire.movies');
    }
}
