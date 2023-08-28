<div>
    <div>
        <button wire:click="applyFilter('')">All</button>
        <button wire:click="applyFilter('movie')">Movies</button>
        <button wire:click="applyFilter('series')">Series</button>
    </div>
    @if($movies->count() != 0)

    @foreach ($movies as $userMovie)
    <div class="border p-4 mb-4">
        <h2>{{ $userMovie->movie_serie->title }}</h2>
        <p>Year: {{ $userMovie->movie_serie->year }}</p>
        <!-- Display movie ratings -->
        @foreach ($userMovie->movie_serie->ratings as $rating)
        <p>{{ $rating['source'] }}: {{ $rating['value'] }}</p>
        @endforeach
        <p>Added by: {{ $userMovie->user->name }}</p>
        <button wire:click="softDeleteMovie('{{ $userMovie->id }}')">Soft Delete</button>
    </div>
    @endforeach
    @else
    <p>You don't have any movies on your list yet.</p>
    @endif
</div>