<div id="add-note" class="hidden max-[405px]:w-[92.8vw] w-96">
    <div class="flex justify-between items-center px-5 py-2 border-b-[1px] border-gray-200 dark:border-slate-500">
        <h3 class="text-[1.8rem] font-bold transition-all duration-300 text-gray-700 dark:text-gray-100">Add Note</h3>
    </div>
    <form id="note-form-create" x-on:submit.prevent="$store.notes.store()">
        @csrf
        <div class="py-3 px-5">
            <x-color />
            <x-input-error
                :label="'Title:'"
                :type="'text'"
                :name="'title'"
                :value="''"
                :class="''"
                :placeholder="'Enter your title'"
            />
            <x-textarea-error
                :label="'Message:'"
                :name="'message'"
                :value="''"
                :placeholder="'Write your thoughts here...'"
            />
        </div>
        <div
            x-data="{
                backNavigation: () => {
                    document.getElementById('add-note').classList.add('hidden');
                    document.getElementById('auth-navigation').classList.remove('hidden');
                    document.getElementById('note-form-create').reset();
                    document.querySelector('p.title-error').innerHTML = '';
                    document.querySelector('p.message-error').innerHTML = '';
                }
            }"
            class="flex justify-between px-5 pb-5"
        >
            <input type="hidden" name="user_id" value="{{session('userid')}}">
            <x-submit
                :text="'Add Note'"
                :buttonId="'note-button-submit-add'"
                :svgId="'note-process-circle-add'"
            />
            <x-cancel
                :text="'Close'"
                :click="'backNavigation'"
            />
        </div>
    </form>
</div>