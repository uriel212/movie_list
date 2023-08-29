<div class="md:my-10">
    <form class="flex flex-col md:flex-row" wire:submit.prevent="fetchApiData">
        <input class="mx-2 my-1 rounded bg-gray-500 placeholder-indigo-900 focus:border-indigo-900 focus:border-2 focus:outline-none focus:ring-0 text-white font-thin text-sm" type="text" wire:model="title" placeholder="Title" required>
        <input class="mx-2 my-1 rounded bg-gray-500 placeholder-indigo-900 focus:border-indigo-900 focus:border-2 focus:outline-none focus:ring-0 text-white font-thin text-sm" type="text" wire:model="type" placeholder="Type">
        <input class="mx-2 my-1 rounded bg-gray-500 placeholder-indigo-900 focus:border-indigo-900 focus:border-2 focus:outline-none focus:ring-0 text-white font-thin text-sm" type="text" wire:model="year" placeholder="Year">
        <button class="mx-auto my-2 px-6 py-2 bg-indigo-700 rounded-md text-white hover:bg-indigo-800" type="submit">Search</button>
    </form>

    <div class="flex flex-col">
        @if ($apiData)

        @if($apiData['Response'] != 'False')
        <div class="mx-auto mt-6">
            <h1 class="font-normal text-lg text-white">Results for {{ $title }}</h1>
        </div>
        <div class="my-12 flex flex-row justify-center space-x-4 md:hidden">
            <button wire:click="nextPage" class="text-white hover:text-indigo-700 focus:text-indigo-700 focus:outline-none">Next Page</button>
            <button wire:click="prevPage" class="text-white hover:text-indigo-700 focus:text-indigo-700 focus:outline-none">Prev Page</button>
        </div>
        <div class="flex flex-wrap justify-center">
            @foreach ($apiData['Search'] as $movie)

            <div class="mx-2 my-6  md:w-2/5 xl:mb-0 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 break-words bg-slate-900 border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="relative">
                        <a class="block shadow-xl rounded-2xl">
                            <img src="{{ $movie['Poster'] }}" alt="img-blur-shadow" class="w-full max-w-full shadow-soft-2xl rounded-2xl" />
                        </a>
                    </div>
                    <div class="mx-auto text-center">
                        <h5 class="text-base text-white">{{ $movie['Title'] }}</h5>
                        <p class="relative z-10 mb-2 leading-normal font-medium text-transparent  text-white text-sm">Year: {{ $movie['Year'] }}</p>
                        <p class="mb-6 leading-normal text-transparent text-sm bg-gradient-to-tl from-gray-500 to-slate-800 bg-clip-text">Type: {{ $movie['Type'] }}</p>
                        <button wire:key="modal-{{ $movie['imdbID'] }}" wire:click="openModal('{{ $movie['imdbID'] }}')" wire:loading.attr="disabled" class="px-8 py-2 mb-4 rounded-md font-bold text-center uppercase align-middle transition-all bg-indigo-700 cursor-pointer text-xs text-white hover:bg-indigo-800 active:bg-indigo-800">View Details</button>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

        <div class="hidden md:my-12 md:flex md:flex-row md:justify-center md:space-x-4">
            <button wire:click="nextPage" class="px-8 py-2 mb-4 rounded-md font-bold text-center uppercase align-middle transition-all bg-indigo-700 cursor-pointer text-xs text-white hover:bg-indigo-800 active:bg-indigo-800">Next Page</button>
            <button wire:click="prevPage" class="px-8 py-2 mb-4 rounded-md font-bold text-center uppercase align-middle transition-all bg-indigo-700 cursor-pointer text-xs text-white hover:bg-indigo-800 active:bg-indigo-800">Prev Page</button>
        </div>
        @else
        <div class="flex flex-row justify-center">
            <h1 class="font-normal text-lg text-white">No results for {{ $title }}...</h1>
        </div>
        @endif
        @endif
    </div>

    <!-- Conditionally render the MovieModal component -->
    @if ($showModal)
    <livewire:movie-modal :movieId="$selectedMovieId" :key="$modalKey" />
    @endif

</div>