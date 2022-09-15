<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public $search  = '';

    public function render()
    {
        $API_KEY = config('services.tmdb.token');

        $resultSearch = [];
        if (strlen($this->search) > 2) {
            $resultSearch = Http::get('https://api.themoviedb.org/3/search/movie?api_key='. $API_KEY .'&query="'. $this->search.'"')->json()['results'];            
        }
        
        // dump($resultSearch);
        return view('livewire.search-dropdown', [
            'result' => $resultSearch
        ]);
    }
}
