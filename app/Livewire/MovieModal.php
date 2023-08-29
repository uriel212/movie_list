<?php

namespace App\Livewire;

use App\Models\MoviesSeries;
use App\Models\Ratings;
use App\Models\UserMoviesSeries;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Livewire;

class MovieModal extends Component
{

    public $movieId;
    public $movieData;
    public $addMovie = true;

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
        $this->verifyIfMovieIsInMyList();
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

            //check if the movie has ratings
            $ratings = Ratings::where('movie_serie_id', $movie_serie->id)->get();

            if($ratings->count() == 0){
                $ratings = $this->movieData['Ratings'];
            
                foreach ($ratings as $rating) {
                    Ratings::create([
                        'movie_serie_id' => $movie_serie->id,
                        'source' => $rating['Source'],
                        'value' => $rating['Value']
                    ]);
                }
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
                $this->movieData = null; 
            } else {
                //If the movie exists we return an message
                return redirect()->back()->with('movieAdded', 'Movie already on your list.');
            }
        }
    }

    public function verifyIfMovieIsInMyList()
    {
        //Getting the movie if exists in the movie_serie table
        if($this->movieData) {
            $movie_serie = MoviesSeries::where('imdb_id', $this->movieData['imdbID'])->first();
                if ($movie_serie) {
                    $userMovieSerie = UserMoviesSeries::where('user_id', auth()->user()->id)
                        ->where('movie_serie_id', $movie_serie->id)
                        ->exists();
                
                    $this->addMovie = !$userMovieSerie;
                } 
        }
    }

    public function softDeleteMovie()
    {
        $movie_delete = MoviesSeries::where('imdb_id', $this->movieData['imdbID'])->first();

        $userMovie = UserMoviesSeries::where('movie_serie_id',$movie_delete->id)
        ->where('user_id', auth()->user()->id)
        ->first();
        if ($userMovie) {
            $userMovie->delete();
        }
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->movieData  = null;
        $this->movieId = null;
        $this->addMovie = false;
    }

    public function render()
    {
        $this->verifyIfMovieIsInMyList();
        return view('livewire.movie-modal');
    }
}
