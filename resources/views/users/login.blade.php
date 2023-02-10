<div id="user-login" class="p-5">
    <form
        x-on:submit.prevent="$store.users.process()"
        id="user-form-login"
    >
        @csrf
        <x-input 
            :label="'Email:'" 
            :type="'text'" 
            :name="'email'" 
            :placeholder="'Enter your email'" 
        />
        <x-input 
            :label="'Password:'" 
            :type="'password'" 
            :name="'password'" 
            :placeholder="'Enter your password'"
        />
        <p class="text-red-500 dark:text-red-400 text-sm font-semibold italic login-error"></p>
        <div class="flex flex-row max-[415px]:flex-col justify-between mt-6 max-[415px]:mt-3">
            <div
                x-data="{
                    toggleLogin: () => {
                        document.getElementById('user-create').classList.remove('hidden');
                        document.getElementById('user-login').classList.add('hidden');
                        document.querySelector('p.name-error').innerHTML = '';
                        document.querySelector('p.email-error').innerHTML = '';
                        document.querySelector('p.password-error').innerHTML = '';
                        document.querySelector('p.login-error').innerHTML = '';
                        document.getElementById('user-form-login').reset();
                    }
                }"
                class="inline-block align-baseline mb-3"
            >
                <span class="text-sm transition-all duration-300 text-gray-700 dark:text-gray-100 pr-[1px]">
                    Don't have account?
                </span>
                <x-link-toggle
                    :text="'register here'"
                    :click="'toggleLogin'"
                />
            </div>
            <x-submit
                :text="'Sign In'"
                :buttonId="'user-button-submit-login'"
                :svgId="'user-process-circle-login'"
            />
        </div>
    </form>
</div>