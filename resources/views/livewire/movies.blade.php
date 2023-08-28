<div>
    <form wire:submit.prevent="fetchApiData">
        <input type="text" wire:model="title" placeholder="Title" required>
        <input type="text" wire:model="type" placeholder="Type">
        <input type="text" wire:model="year" placeholder="Year">
        <input type="text" wire:model="page" placeholder="Page">
        <button type="submit">Fetch API Data</button>
    </form>

    @if ($apiData)
    <h1>Results for {{ $title }}</h1>
    @foreach ($apiData['Search'] as $movie)

    <div class="w-full max-w-full mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="relative">
                <a class="block shadow-xl rounded-2xl">
                    <img src="{{ $movie['Poster'] }}" alt="img-blur-shadow" class="max-w-full shadow-soft-2xl rounded-2xl" />
                </a>
            </div>
            <div class="flex-auto px-1 pt-6">
                <h5>{{ $movie['Title'] }}</h5>
                <p class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">Year: {{ $movie['Year'] }}</p>
                </a>
                <p class="mb-6 leading-normal text-sm">{{ $movie['Type'] }}</p>
                <div class="flex items-center justify-between">
                    <button wire:key="modal-{{ $movie['imdbID'] }}" wire:click="openModal('{{ $movie['imdbID'] }}')" wire:loading.attr="disabled" class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">View Project</button>
                </div>
            </div>
        </div>
    </div>

    @endforeach
    @endif
    <!-- Conditionally render the MovieModal component -->
    @if ($showModal)
    <livewire:movie-modal :movieId="$selectedMovieId" :key="$modalKey"/>
    @endif

</div>