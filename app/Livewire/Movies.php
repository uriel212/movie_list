<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Movies extends Component
{
    // public $imdbId;
    public $title;
    public $type;
    public $page;
    public $year;
    public $apiData;
    public $showModal = false;
    public $selectedMovieId;

    public $modalKey = 0;

    public function openModal($imdbId)
    {
        $this->selectedMovieId = $imdbId;
        $this->showModal = true;

        $this->modalKey++;
    }

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

    public function render()
    {
        return view('livewire.movies');
    }
}
