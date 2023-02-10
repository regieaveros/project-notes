<div
    x-data="{
        color_value:
            localStorage.getItem('color') === 'bg-gray-50' ? 'bg-gray-50' :
            localStorage.getItem('color') === 'bg-gray-400' ? 'bg-gray-400' :
            localStorage.getItem('color') === 'bg-orange-400' ? 'bg-orange-400' :
            localStorage.getItem('color') === 'bg-emerald-400' ? 'bg-emerald-400' :
            localStorage.getItem('color') === 'bg-purple-400' ? 'bg-purple-400' :
            localStorage.getItem('color') === 'bg-cyan-400' ? 'bg-cyan-400' :
            localStorage.getItem('color') === 'bg-red-400' ? 'bg-red-400' :
            ''
        ,
        position_check:
            localStorage.getItem('color') === 'bg-gray-50' ? 'top-0' :
            localStorage.getItem('color') === 'bg-gray-400' ? 'top-8' :
            localStorage.getItem('color') === 'bg-orange-400' ? 'top-16' :
            localStorage.getItem('color') === 'bg-emerald-400' ? 'top-24' :
            localStorage.getItem('color') === 'bg-purple-400' ? 'top-32' :
            localStorage.getItem('color') === 'bg-cyan-400' ? 'top-40' :
            localStorage.getItem('color') === 'bg-red-400' ? 'top-48' :
            'hidden'
        ,
        message: localStorage.getItem('color') ? '' : 'Select Color',
        colors: [
            { id: 1, name: 'color_white', color: 'bg-gray-50', position: 'top-0' },
            { id: 2, name: 'color_gray', color: 'bg-gray-400', position: 'top-8' },
            { id: 3, name: 'color_orange', color: 'bg-orange-400', position: 'top-16' },
            { id: 4, name: 'color_emerald', color: 'bg-emerald-400', position: 'top-24' },
            { id: 5, name: 'color_purple', color: 'bg-purple-400', position: 'top-32' },
            { id: 6, name: 'color_cyan', color: 'bg-cyan-400', position: 'top-40' },
            { id: 7, name: 'color_red', color: 'bg-red-400', position: 'top-48' },
        ],
    }"
>
    <button
        @click="
        searchColor = !searchColor
            $nextTick(() => { 
                document.getElementById('rotate-arrow').classList.toggle('rotate-180');
            });
        " 
        type="button" 
        class="flex justify-between items-center w-[7.7rem] h-10 bg-gray-300 text-md text-gray-700 px-1 rounded-md"
    >
        <div :class="color_value" x-text="message" class="w-24 py-3 text-sm font-semibold ml-2"></div>
        <i id="rotate-arrow" class="fas fa-angle-down text-md text-gray-400 transition duration-150 mx-1.5"></i>
    </button>
    <template x-if="true">
        <div
            x-transition:enter.opacity
            x-transition:enter.duration.200ms
            x-transition:leave.opacity
            x-transition:leave.duration.200ms
            x-show="searchColor" 
            class="absolute top-11 right-0 z-10 w-full h-60 bg-gray-50 shadow p-2"
        >
            <div
                class="flex flex-col justify-center items-center h-full relative border-[1px] border-gray-400"
            >   
                <template x-for="color in colors" :key="color.id">
                    <div :class="color.color" class="relative h-[14.286%] w-full">
                        <input 
                            type="radio" 
                            :id="color.name" 
                            name="search-color" 
                            :class="color.peer" 
                            class="appearance-none"
                            :value="color.color"
                            x-model="color_value"
                        />
                        <label 
                            @click="
                                searchColor = !searchColor
                                position_check = color.position
                                message = ''
                                $nextTick(() => { 
                                    document.getElementById('rotate-arrow').classList.toggle('rotate-180');
                                });
                            " 
                            :for="color.name"
                            :class="color.color"
                            class="cursor-pointer absolute z-10 h-full w-full"
                        ></label>
                    </div>
                </template>
                <div
                    @click="
                        searchColor = !searchColor
                        color_value = ''
                        position_check = 'hidden'
                        message = 'Select Color'
                        $nextTick(() => { 
                            document.getElementById('rotate-arrow').classList.toggle('rotate-180');
                        });
                    "
                    :class="position_check" 
                    class="flex justify-center items-center cursor-pointer absolute top-0 z-10 text-center h-[14.2%] w-full text-md transform transition-transform ring-1 ring-slate-600 text-slate-600 hover:text-red-700 hover:ring-red-700 group"
                >
                    <span class="inline-block group-hover:hidden">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="hidden group-hover:inline-block">
                        <i class="fas fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
    </template>
</div>