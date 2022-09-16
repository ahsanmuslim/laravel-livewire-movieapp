@extends('layouts.main')

@section('content')

{{-- movie detail --}}
<div class="movie-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex items-center flex-col md:flex-row">
        <img src="{{ $detail['poster_path'] }}" alt="movie" class="w-82 md:w-96">
        <div class="ml-12 md:ml-24">
            <h2 class="text-3xl font-semibold">{{ $detail['title'] }}</h2>

            <div class="flex items-center flex-wrap text-gray-400 text-sm mt-2">
                <svg class="fill-orange-500 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                </svg>                              
                <span>Star</span>
                <span class="ml-1">{{ $detail['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $detail['release_date'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $detail['genres'] }}</span>
            </div>

            <p class="text-gray-400 mt-8">{{ $detail['overview'] }}</p>

            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured Cast</h4>
                <div class="flex mt-4">
                    <div class="flex items-center">

                        @foreach ($detail['crew'] as $crew)
                        <div class="mr-8">
                            <div>{{ $crew['name'] }}</div>
                            <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                        </div>  
                        @endforeach

                    </div>
                </div>
            </div>

            <div x-data="{ isOpen: false }">
                @if (count($detail['videos']) > 0)
                <div class="mt-12 flex items-center">
                    <button 
                    @click="isOpen=true" 
                    @keydown.escape.window="isOpen=false"
                    class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-6 py-3 hover:bg-orange-600 transition duration-150">
                        <svg class="w-4 fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                        </svg>                      
                        <span>Play Trailer</span>
                    </buttonhref=>
                </div>

                {{-- modal for play video --}}
                <template x-if="isOpen">
                <div
                    style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                >
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button
                                    @click="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%" x-show="isOpen">
                                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $detail['videos']['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </template>
                @endif
            </div>


        </div>
    </div>
</div> 
{{-- akhir dari movie info --}}

{{-- Cast  --}}
<div class="movie-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold">Cast</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">

            {{-- card movies    --}}
            @foreach ($detail['cast'] as $cast)
            <div class="mt-8">
                <a href="#">
                    <img src="https://image.tmdb.org/t/p/w300/{{ $cast['profile_path'] }}" alt="film" class="hover:opacity-75 transition duration-300">
                </a>
                <div class="mt-2">
                    <a href="#" class="text-lg mt-2 hover:text-gray-400">{{ $cast['name'] }}</a>
                    <div>
                        <span class="text-gray-400">{{ $cast['character'] }}</span>
                    </div>
                </div>
            </div>            
            @endforeach

        </div>

    </div>
</div>
{{-- End of Cast  --}}

{{-- Image  --}}
<div class="movie-image border-b border-gray-800" x-data="{ isOpen: false, image: ''}">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-semibold">Images</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($detail['images'] as $image)
            {{-- card movies    --}}
            <div class="mt-4">
                <a
                    @click.prevent="
                        isOpen = true
                        image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                    "
                    href="#"
                >
                    <img src="https://image.tmdb.org/t/p/w300/{{ $image['file_path'] }}" alt="film" class="hover:opacity-75 transition duration-300">
                </a>
            </div> 
            @endforeach    
        </div>

        {{-- modal image  --}}
        <div
        style="background-color: rgba(0, 0, 0, .5);"
        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
        x-show="isOpen"
        >
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="bg-gray-900 rounded">
                    <div class="flex justify-end pr-4 pt-2">
                        <button
                            @click="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="text-3xl leading-none hover:text-gray-300">&times;
                        </button>
                    </div>
                    <div class="modal-body px-8 py-8">
                        <img :src="image" alt="poster">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
{{-- End of Images  --}}


    
@endsection