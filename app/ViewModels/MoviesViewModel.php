<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowMovies; 
    public $genres;

    public function __construct($popularMovies, $nowMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowMovies = $nowMovies;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }
    
    public function nowMovies()
    {
        return $this->formatMovies($this->nowMovies);
    }
        
    public function genres()
    {
        return $genres = collect($this->genres)->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        });
    }
    
    public function formatMovies($movies)
    {
        return collect($movies)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'. $movie['poster_path'],
                'release_date' => \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y'),
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'genres' => $genresFormatted
            ])->only([
                'id', 'genre_ids', 'title', 'overview', 'poster_path', 'release_date', 'vote_average', 'genres', 
            ]);
        });
    }
}
