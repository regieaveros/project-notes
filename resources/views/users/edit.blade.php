<div id="user-profile" class="hidden max-[405px]:w-[92.8vw] w-96">
    <form id="user-form-update" x-on:submit.prevent="$store.users.update()">
        @method('PUT')
        @csrf
        <div class="flex justify-between items-center px-5 py-2 border-b-[1px] border-gray-200 dark:border-slate-500">
            <h3 class="text-[1.8rem] font-bold transition-all duration-300 text-gray-700 dark:text-gray-100">Profile</h3>
            <x-toggle-password />
        </div>
        <div class="flex justify-center px-5 mt-4">
            <x-file-image />
        </div>
        <div class="px-5 pb-5">
            <x-input-error
                :label="'Name:'"
                :type="'text'"
                :name="'name'"
                :value="session('name')"
                :class="''"
                :placeholder="'Enter your name'"
            />
            <x-input-error
                :label="'Email:'"
                :type="'text'"
                :name="'email'"
                :value="session('email')"
                :class="''"
                :placeholder="'Enter your email'"
            />
            <x-input-error
                :label="'New Password:'"
                :type="'password'"
                :name="'password'"
                :value="''"
                :class="'disabled:bg-gray-200 dark:disabled:bg-slate-700'"
                :placeholder="'Enter your password'"
            />
            <x-input-error
                :label="'Confirm New Password:'"
                :type="'password'"
                :name="'password_confirmation'"
                :value="''"
                :class="'disabled:bg-gray-200 dark:disabled:bg-slate-700'"
                :placeholder="'Enter your confirm password'"
            />
            <div
                x-data="{
                    backNavigation: () => {
                        document.getElementById('user-profile').classList.add('hidden');
                        document.getElementById('auth-navigation').classList.remove('hidden');
                        document.querySelector('p.name-error').innerHTML = '';
                        document.querySelector('p.email-error').innerHTML = '';
                        document.querySelector('p.password-error').innerHTML = '';
                        document.querySelector('input[type=checkbox]').checked = false;
                        document.querySelector('input[name=password]').disabled = true;
                        document.querySelector('input[name=password_confirmation]').disabled = true;
                        document.querySelector('input[name=password]').value = '';
                        document.querySelector('input[name=password_confirmation]').value = '';
                        document.querySelector('input[name=name]').value = '{{session('name')}}';
                        document.querySelector('input[name=email]').value = '{{session('email')}}';
                        document.getElementById('imageSrc').style.backgroundImage = 'url(@if(!empty(session('profile'))) <?= asset('uploads/images/'.session('profile')) ?> @else https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png @endif)';
                        document.querySelector('input[type=file]').value = '';
                    }
                }"
                class="flex justify-between mt-8"
            >
                <input type="hidden" name="user_id" value="{{session('userid')}}" />
                <x-submit
                    :text="'Update'"
                    :buttonId="'user-button-submit-update'"
                    :svgId="'user-process-circle-update'"
                />
                <x-cancel
                    :text="'Close'"
                    :click="'backNavigation'"
                />
            </div>
        </div>
    </form>
</div>