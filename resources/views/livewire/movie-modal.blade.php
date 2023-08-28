<div>
    <!-- Modal Content -->
        <div class="modal">
            @if($movieData)
                <img src="{{ $movieData['Poster'] }}" alt="">
                <h1>{{ $movieData['Title'] }}</h1>
                <h2>{{ $movieData['Year'] }}</h2>
                <h3>{{ $movieData['Genre'] }}</h3>
                <p>{{ $movieData['Director'] }}</p>
                <p>{{ $movieData['Type'] }}</p>
                <p>{{ $movieData['Plot'] }}</p>
                @foreach ($movieData['Ratings'] as $rating)
                    <p>{{ $rating['Source'] }}: {{ $rating['Value'] }}</p>
                @endforeach
                <button wire:click="addToMyList" >Add to my List</button>
                <button wire:click="closeModal">Close</button>

            @endif
        </div>
</div>
