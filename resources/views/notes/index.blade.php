@include('partials.header', ['title' => 'Homepage'])
    <x-nav />
    <div id="navigation_mask" class="hidden fixed top-[58px] right-0 z-10 bg-gray-700 h-full max-h-full w-full opacity-50"></div>
    <div id="modal_mask" class="hidden fixed top-0 right-0 z-20 bg-gray-700 h-full max-h-full w-full opacity-50"></div>
    <div x-data="{ modal: false }" class="container mx-auto mt-24 mb-10 px-3">
        <div class="flex relative justify-center">
            <template x-if="true">
                @include('notes.show')
            </template>
        </div>
        <form
            x-on:submit="$store.notes.filter()" 
            class="flex max-[488px]:flex-col flex-row justify-start items-end mb-5" 
            action="/search" method="GET"
        >
            @csrf
            <div class="flex flex-row items-end my-2 w-96 max-[488px]:w-full">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none text-xl">
                        <i class="fas fa-search text-gray-700 dark:text-gray-200"></i>
                    </div>
                    <input
                        x-init="document.querySelector('input[name=search]').value = localStorage.getItem('search');"
                        type="text" 
                        name="search"
                        class="block w-full bg-transparent active:bg-transparent outline-none border-b-2 border-gray-500 text-gray-700 dark:text-gray-200 text-md pl-10 p-2"
                        placeholder="Search"
                    />
                </div>
                <div x-data="{ searchColor: false }" class="relative ml-5">
                    <x-color-search />
                </div>
            </div>
            <button class="w-auto h-10 bg-gray-300 text-md text-gray-700 ml-5 my-2 px-5 rounded-md focus:ring-1 ring-offset-1 ring-gray-400 drop-shadow-sm transition duration-100 hover:scale-90 active:scale-100" type="submit">
                Search
            </button>
        </form>
        @if($count != 0)
            <div class="grid justify-center xl:grid-cols-4 lg:grid-cols-3 sm:grid-cols-2 gap-5">
                @foreach ($notes as $note)
                    <div
                        x-data="{noteList:$id('noteList')}"
                        x-init="
                            document.getElementById(`${noteList}`).classList.remove('scale-0');
                            document.getElementById(`${noteList}`).classList.add('scale-100');
                        "
                        :id="noteList"
                        class="relative block transform transition-all duration-150 ease-out scale-0"
                    >
                        <x-note :data="$note" />
                        <x-note-delete :data="$note" />
                    </div>
                @endforeach
            </div>
            <div class="mx-auto my-5">
                {{ $notes->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <div class="text-xl text-gray-700 text-center m-64">
                <h2>Notes Not Found</h2>
            </div>
        @endif
    </div>
@include('partials.footer')