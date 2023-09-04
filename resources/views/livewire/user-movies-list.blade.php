<div class="py-12">
    <div class="flex flex-row justify-center space-x-6">
        <button class="text-white hover:text-indigo-700 focus:text-indigo-700 focus:outline-none" wire:click="applyFilter('')">All</button>
        <button class="text-white hover:text-indigo-700 focus:text-indigo-700 focus:outline-none" wire:click="applyFilter('movie')">Movies</button>
        <button class="text-white hover:text-indigo-700 focus:text-indigo-700 focus:outline-none" wire:click="applyFilter('series')">Series</button>
    </div>
    @if($movies->count() != 0)

    <div class="flex flex-col">
        <div class="flex flex-wrap justify-center">
            @foreach ($movies as $userMovie)

            <div class="mx-2 my-6  md:w-2/5 xl:mb-0 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 break-words bg-slate-900 border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="relative">
                        <a class="block shadow-xl rounded-2xl">
                            <img src="{{ $userMovie->movie_serie->image }}" alt="img-blur-shadow" class="w-full max-w-full shadow-soft-2xl rounded-2xl" />
                        </a>
                    </div>
                    <div class="mx-auto text-center">
                        <h5 class="text-base text-white">{{ $userMovie->movie_serie->title }}</h5>
                        <p class="relative z-10 mb-2 leading-normal font-medium text-transparent  text-white text-sm">Year: {{ $userMovie->movie_serie->year }}</p>
                        <p class="mb-6 leading-normal text-transparent text-sm bg-gradient-to-tl from-gray-500 to-slate-800 bg-clip-text">Type: {{ $userMovie->movie_serie->type }}</p>
                        <button wire:click="softDeleteMovie('{{ $userMovie->id }}')" class="uppercase inline-flex w-full justify-center rounded-md bg-red-600 my-4 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete of my List</button>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
    @else
    <p>You don't have any movies/series on your list yet.</p>
    @endif
</div>