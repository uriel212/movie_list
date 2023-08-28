<div>
    @if($movies->count() != 0)
        @foreach ($movies as $userMovie)
            <div class="border p-4 mb-4">
                <h2>{{ $userMovie->movie->title }}</h2>
                <p>Year: {{ $userMovie->movie->year }}</p>
                <!-- Display movie ratings -->
                @foreach ($userMovie->movie->ratings as $rating)
                    <p>{{ $rating['source'] }}: {{ $rating['value'] }}</p>
                @endforeach
                <p>Added by: {{ $userMovie->user->name }}</p>
            </div>
        @endforeach
    @else
        <p>You don't have any movies on your list yet.</p>
    @endif
</div>