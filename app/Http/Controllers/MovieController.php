<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $API_KEY = config('services.tmdb.token');
        //get data Movies popular & genre movie
        $popularMovies = Http::get('https://api.themoviedb.org/3/movie/popular', ['api_key' => $API_KEY])->json()['results'];
        $nowMovies = Http::get('https://api.themoviedb.org/3/movie/now_playing', ['api_key' => $API_KEY])->json()['results'];
        $genreMovies = Http::get('https://api.themoviedb.org/3/genre/movie/list', ['api_key' => $API_KEY])->json()['genres'];

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowMovies,
            $genreMovies
        );
        
        return view('index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $API_KEY = config('services.tmdb.token');

        $detailMovie = Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.$API_KEY.'&append_to_response=credits,videos,images')->json();

        $viewModel = new MovieViewModel(
            $detailMovie
        );
        
        return view('show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
