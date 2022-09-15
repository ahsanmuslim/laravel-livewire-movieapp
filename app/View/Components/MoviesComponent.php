<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MoviesComponent extends Component
{
    public $movie, $genres;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($movie, $genres)
    {
        $this->movie = $movie;
        $this->genres = $genres;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.movies-component');
    }
}
