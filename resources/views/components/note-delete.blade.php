<div id="delete-note-{{ $data->id }}" class="hidden transition-all duration-300 w-full rounded overflow-hidden shadow-lg bg-gray-50">
    <div class="transition-all duration-300 bg-red-500 text-xl text-white font-bold py-3 px-3 border-b-2 border-gray-200">
        Warning!
    </div>
    <div class="px-6 py-8">
        <p class="transition-all duration-100 text-gray-700 text-lg">
            Do you want to delete this note?
        </p>
    </div>
    <div class="transition-all duration-300 flex justify-end pt-2 pb-1 border-t-[1px] border-gray-200">
        <form class="flex flex-row" x-on:submit.prevent="$store.notes.destroy({{ $data->id }})">
            @method('delete')
            @csrf
            <button id="note-button-submit-delete-{{ $data->id }}" type="submit" class="flex justify-center items-center bg-red-500 rounded-full w-24 h-9 px-2 pb-[3px] font-semibold text-gray-100 mr-3 mb-2 transition ease-in-out duration-300 ring-offset-1 ring-red-500 hover:bg-red-600 hover:scale-90 focus:scale-100 focus:ring-1 active:scale-90 disabled:opacity-50">
                <svg id="note-process-circle-add-{{ $data->id }}" aria-hidden="true" role="status" class="hidden w-5 h-5 mr-1 text-slate-400 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                </svg>
                Delete
            </button>
            <button
            type="button"
                x-data="{
                    btn_cancel_{{ $data->id }}: () => {
                        document.getElementById('delete-note-{{ $data->id }}').classList.add('hidden');
                        document.getElementById('display-note-{{ $data->id }}').classList.remove('hidden');
                        document.querySelectorAll('button.btnDisabled').forEach(elem => {
                            elem.disabled = false;
                        });
                    }
                }"
                @click="btn_cancel_{{ $data->id }}"
                class="bg-blue-500 rounded-full w-24 h-9 px-2 pb-[3px] font-semibold text-gray-100 mr-3 mb-2 transition ease-in-out duration-300 ring-offset-1 ring-blue-500 hover:bg-blue-600 hover:scale-90 focus:scale-100 focus:ring-1 active:scale-90"
            >
                Cancel
        </button>
    </form>
    </div>
</div>