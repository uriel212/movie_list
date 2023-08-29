<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Movies extends Component
{
    // public $imdbId;
    public $title;
    public $type;
    public $page = 1;
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

    public function nextPage()
    {
        $this->page++;
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
        return $this->apiData = $response->json();
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
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
            return $this->apiData = $response->json();
        }
    }

    public function fetchApiData()
    {
        try {
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
            return $this->apiData = $response->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function render()
    {
        return view('livewire.movies');
    }
}
