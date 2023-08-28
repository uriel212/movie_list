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
            <div class="flex flex-col">
                <img src="{{ $movie['Poster'] }}" alt="{{ $movie['Title'] }}">
                <h1>{{ $movie['Title'] }}</h1>
                <p>{{ $movie['Year'] }}</p>
                <button wire:click="addToMyList">Add to my list</button>
            </div>
        @endforeach
       
    @endif

    
</div>