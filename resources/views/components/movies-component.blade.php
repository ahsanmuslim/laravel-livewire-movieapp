<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    {{-- card movies    --}}
    <div class="mt-8">
        <a href="/movie/{{ $movie['id'] }}">
            <img src="{{ $movie['poster_path'] }}" alt="film" class="hover:opacity-75 transition duration-300">
        </a>
        <div class="mt-2">
            <a href="/movie/{{ $movie['id'] }}" class="text-lg mt-2 hover:text-gray-400">{{ $movie['title'] }}</a>
            <div class="flex items-center text-gray-400 mt-1">
                <svg class="fill-orange-500 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                </svg>                              
                <span>Star</span>
                <span class="ml-1">{{ $movie['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $movie['release_date'] }}</span>
            </div>
            <div class="text-gray-400 text-sm">
                <span>
                    @foreach ($movie['genre_ids'] as $gid)
                        {{ $genres->get($gid) }}@if(!$loop->last),@endif
                    @endforeach
                </span>
            </div>
        </div>
    </div>

</div>