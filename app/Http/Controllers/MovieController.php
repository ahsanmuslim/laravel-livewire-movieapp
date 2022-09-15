<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        //collect data genre
        $genres = collect($genreMovies)->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['name']];
        });

        return view('index', [
            'popularMovies' => $popularMovies,
            'nowMovies' => $nowMovies,
            'genres' => $genres
        ]);
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

        return view('show', [
            'detail' => $detailMovie
        ]);
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
