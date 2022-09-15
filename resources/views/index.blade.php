@extends('layouts.main')

@section('content')
    
    <div class="container mx-auto px-4 pt-16">

        {{-- popular movies --}}
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

                @foreach ($popularMovies as $movie)                 
                    <x-movies-component :movie="$movie" :genres="$genres"/>
                @endforeach
                
            </div>
        </div>
        {{-- end of popular movie --}}
    

        {{-- now playing --}}
        <div class="now-playing-movies mt-6">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            {{-- card now playing movies --}}
            @foreach ($nowMovies as $movie)                 
                <x-movies-component :movie="$movie" :genres="$genres"/>
            @endforeach

            </div>
        </div>
        {{-- end of now playing --}}
    
    </div>

@endsection