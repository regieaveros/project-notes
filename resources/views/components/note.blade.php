<div id="display-note-{{ $data->id }}" class="transition-all duration-300 h-full rounded overflow-hidden shadow-lg {{ $data->color }}">
    <div class="px-6 pt-3 pb-8 h-80">
        <div class="flex justify-between items-start mb-6">
            <div class="flex justify-start items-center">
                <div class="mr-3">
                    <div class="bg-cover bg-center w-9 h-9 rounded-full bg-no-repeat ring-2 ring-gray-400 ring-offset-1" style="background-image: url(@if(!empty($data->profile))'<?= asset('uploads/images/'.$data->profile) ?>'@else 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' @endif);"></div>
                </div>
                <div class="text-gray-700">
                    <h3 class="text-md font-bold">{{ $data->name }}</h3>
                    <p
                        x-init="
                            document.getElementById('post-date-{{ $data->id }}').innerHTML = moment('{{ $data->created_at }}').fromNow();
                        "
                        id="post-date-{{ $data->id }}"
                        class="text-xs"
                    ></p>
                </div>
            </div>
            <button
                x-on:click="
                    modal = ! modal
                    $store.notes.show({{ $data->id }});
                    $nextTick(() => { 
                        document.getElementById('modal_mask').classList.toggle('hidden');
                        document.body.classList.toggle('overflow-hidden');
                    });
                " 
                class="text-md text-center outline-none rounded text-gray-700 bg-stone-200 py-1 px-[0.4rem] shadow-sm transition transform duration-150 hover:-translate-y-1 hover:bg-stone-300">
                <i class="fa-solid fa-share-from-square"></i>
            </button>
        </div>
        <div class="font-bold text-gray-70 text-xl mb-2">{{ $data->title }}</div>
        <p class="h-[7.3rem] break-all transition-all overflow-hidden line-clamp duration-100 text-gray-700 text-base">
            {{ $data->message }}
        </p>
    </div>
    @auth
    <div class="transition-all duration-300 flex justify-end pt-2 pb-1 border-t-[1px] border-gray-200 dark:border-gray-600">
        <button
            x-on:click="
            btnOpen = !btnOpen
            $nextTick(() => {
                document.querySelector('.tham').classList.toggle('tham-active');
                document.getElementById('navigation_mask').classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
                document.getElementById('auth-navigation').classList.toggle('hidden');
                document.getElementById('edit-note').classList.remove('hidden');
                document.querySelector('p.edit-title-error').innerHTML = '';
                document.querySelector('p.edit-message-error').innerHTML = '';
                document.querySelector('*[name=edit-id]').value = {{ $data->id }};
                document.querySelector('*[name=edit-title]').value = `{{ $data->title }}`;
                document.querySelector('*[name=edit-message]').value = `{{ $data->message }}`;
                switch ('{{ $data->color }}') {
                    case 'bg-gray-400':
                        document.getElementById('edit_gray').checked = true;
                        break;
                    case 'bg-orange-400':
                        document.getElementById('edit_orange').checked = true;
                        break;
                    case 'bg-emerald-400':
                        document.getElementById('edit_emerald').checked = true;
                        break;
                    case 'bg-purple-400':
                        document.getElementById('edit_purple').checked = true;
                        break;
                    case 'bg-cyan-400':
                        document.getElementById('edit_cyan').checked = true;
                        break;
                    case 'bg-red-400':
                        document.getElementById('edit_red').checked = true;
                        break;
                    case 'bg-gray-50':
                        document.getElementById('edit_white').checked = true;
                } 
            });
            "
            class="btnDisabled inline-block bg-blue-500 rounded-full w-11 h-9 px-2 pb-[3px] text-md font-semibold text-gray-100 mr-3 mb-2 transition ease-in-out duration-300 ring-offset-1 ring-blue-500 hover:bg-blue-600 hover:scale-90 focus:scale-100 focus:ring-2 active:scale-90 disabled:opacity-40"><i class="fa-solid fa-pen-to-square"></i></button>
        <button
            x-data="{
                btn_delete_{{ $data->id }}: () => {
                    document.getElementById('display-note-{{ $data->id }}').classList.add('hidden');
                    document.getElementById('delete-note-{{ $data->id }}').classList.remove('hidden');
                    document.querySelectorAll('button.btnDisabled').forEach(elem => {
                        elem.disabled = true;
                    });
                }
            }"
            @click="btn_delete_{{ $data->id }}"
            class="btnDisabled inline-block bg-red-500 rounded-full w-11 h-9 px-2 pb-[3px] text-md font-semibold text-gray-100 mr-3 mb-2 transition ease-in-out duration-300 ring-offset-1 ring-red-500 hover:bg-red-600 hover:scale-90 focus:scale-100 focus:ring-2 active:scale-90 disabled:opacity-40">
            <i class="fa-solid fa-trash"></i></button>
    </div>
    @endauth
</div>