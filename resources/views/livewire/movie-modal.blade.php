<div>
    <div class="modal">
        @if($movieData)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-70 transition-opacity" wire:click="closeModal"></div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div class="relative transform overflow-hidden rounded-lg bg-slate-900 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-slate-900 px-4 pb-4 pt-5">
                            <div class="">
                                <div class="mx-auto flex h-full w-3/5 flex-shrink-0 items-center justify-center rounded-full ">
                                    <img src="{{ $movieData['Poster'] }}" alt="🎥">
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">{{ $movieData['Title'] }}</h3>
                                    <div class="mt-2">
                                        <h2 class="text-gray-500 text-xs">Year: {{ $movieData['Year'] }}</h2>
                                        <h3 class="text-gray-500 text-xs">Genre: {{ $movieData['Genre'] }}</h3>
                                        <p  class="text-gray-500 text-xs">Director: {{ $movieData['Director'] }}</p>
                                        <p  class="text-gray-500 text-xs">Type: {{ $movieData['Type'] }}</p>
                                        @foreach ($movieData['Ratings'] as $rating)
                                        <p class="text-gray-500 text-xs">{{ $rating['Source'] }}: {{ $rating['Value'] }}</p>
                                        @endforeach
                                        <p class="text-xs text-gray-500">{{ $movieData['Plot'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-900 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            @if($addMovie)
                            <button wire:click="addToMyList" type="button" class="uppercase inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Add to my List</button>
                            @else
                            <button wire:click="softDeleteMovie" type="button" class="uppercase inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete of my List</button>
                            @endif
                            <button wire:click="closeModal" type="button" class="uppercase mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>