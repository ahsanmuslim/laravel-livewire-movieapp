<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        return $this->movie = $movie;
    }

    public function detail()
    {
        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'. $this->movie['poster_path'],
            'release_date' => \Carbon\Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(2)->map(function ($crew) {
                return collect($crew)->only('name', 'job')->toArray();
            })->toArray(),
            'cast' => collect($this->movie['credits']['cast'])->take(5)->map(function ($cast) {
                return collect($cast)->only('name', 'profile_path', 'character')->toArray();
            })->toArray(),
            'images' => collect($this->movie['images']['backdrops'])->take(9)->map(function ($images) {
                return collect($images)->only('file_path')->toArray();
            })->toArray(),
            'videos' => collect($this->movie['videos']['results'])->take(1)->mapWithKeys(function ($video, $key) {
                return ['key' => $video['key']];
            }),
        ])->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date', 'videos', 'images', 'crew', 'cast', 'images'
        ]);
    }
}
