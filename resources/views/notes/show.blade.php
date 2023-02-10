<div
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    x-show="modal" 
    class="fixed z-20 top-16 max-[541px]:w-11/12 w-full max-w-lg bg-gray-50 shadow-sm"
>
    <button
        x-on:click="
            modal = ! modal
            $nextTick(() => { 
                document.getElementById('modal_mask').classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });
        " 
        class="absolute top-[-0.6rem] right-[-0.6rem] text-xl text-center outline-none w-7 h-7 rounded-full text-gray-100 bg-red-500 px-1 transition duration-200 shadow hover:scale-110">
        <i class="fa-solid fa-xmark"></i>
    </button>
    
    <div id="modal-data" class="hidden text-gray-700 pt-2 pb-5">

        <div class="border-b-2 border-gray-200">
            <div class="flex justify-start items-center px-5 pb-2">
                <div id="profile-image" class="block max-[322px]:hidden bg-cover bg-center w-12 h-12 rounded-full border-2 border-gray-400 bg-no-repeat" style="background-image: url('https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png');"></div>
                <div class="ml-2 text-gray-700">
                    <h3 id="name" class="font-bold text-lg"></h3>
                    <div class="flex max-[425px]:flex-col flex-row items-baseline mt-[-0.1rem]">
                        <p class="text-xs mr-1 text-gray-500">Posted date:</p>
                        <p id="date" class="text-sm italic"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 px-5 h-[26rem] overflow-auto">
            <h2 id="title" class="mb-4 font-bold text-xl text-gray-700"></h2>
            <p id="message" class="text-md text-gray-500 break-all"></p>
        </div>
    </div>

    <div id="modal-loading" class="animate-pulse py-7 px-5">
        <div class="flex justify-start items-center">
            <div class="rounded-full bg-slate-200 h-11 w-11"></div>
            <div class="ml-2">
                <div class="h-4 w-32 bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-24 bg-slate-200 rounded"></div>
            </div>
        </div>
        <div class="mt-20">
            <div class="h-5 w-40 bg-slate-200 rounded"></div>
            <div class="mt-5">
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
                <div class="h-3 w-full bg-slate-200 rounded mb-3"></div>
            </div>
        </div>
        
    </div>
</div>
