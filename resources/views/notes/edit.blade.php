<div id="edit-note" class="hidden max-[405px]:w-[92.8vw] w-96">
    <div class="flex justify-between items-center px-5 py-2 border-b-[1px] border-gray-200 dark:border-slate-500">
        <h3 class="text-[1.8rem] font-bold transition-all duration-300 text-gray-700 dark:text-gray-100">Edit Note</h3>
    </div>
    <form id="note-form-edit" x-on:submit.prevent="$store.notes.update()">
        @method('PUT')
        @csrf
        <div class="py-3 px-5">
            <x-color-edit />
            <x-input-error
                :label="'Title:'"
                :type="'text'"
                :name="'edit-title'"
                :value="''"
                :class="''"
                :placeholder="'Enter your title'"
            />
            <x-textarea-error
                :label="'Message:'"
                :name="'edit-message'"
                :value="''"
                :placeholder="'Write your thoughts here...'"
            />
        </div>
        <div
            x-data="{
                btnOpen: () => {
                    btnOpen = false;
                    document.querySelector('.tham').classList.toggle('tham-active');
                    document.getElementById('navigation_mask').classList.toggle('hidden');
                    document.getElementById('auth-navigation').classList.toggle('hidden');
                    document.getElementById('edit-note').classList.add('hidden');
                    document.body.classList.toggle('overflow-hidden');
                    document.querySelector('p.edit-title-error').innerHTML = '';
                    document.querySelector('p.edit-message-error').innerHTML = '';
                }
            }"
            class="flex justify-between px-5 pb-5"
        >
            <input type="hidden" name="edit-id" value="">
            <x-submit
                :text="'Edit Note'"
                :buttonId="'note-button-submit-edit'"
                :svgId="'note-process-circle-edit'"
            />
            <x-cancel
                :text="'Close'"
                :click="'btnOpen'"
            />
        </div>
    </form>
</div>