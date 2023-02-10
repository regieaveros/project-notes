<div id="user-create" class="hidden p-5">
    <form
        x-on:submit.prevent="$store.users.store()"
        id="user-form-create"
    >
        @csrf
        <x-input-error
            :label="'Name:'"
            :type="'text'"
            :name="'name'"
            :value="''"
            :class="''"
            :placeholder="'Enter your name'"
        />
        <x-input-error
            :label="'Email:'"
            :type="'text'"
            :name="'email'"
            :value="''"
            :class="''"
            :placeholder="'Enter your email'"
        />
        <x-input-error
            :label="'Password:'"
            :type="'password'"
            :name="'password'"
            :value="''"
            :class="''"
            :placeholder="'Enter your password'"
        />
        <x-input 
            :label="'Confirm Passwor:'" 
            :type="'password'" 
            :name="'password_confirmation'"
            :value="''"
            :placeholder="'Enter your confirm password'" 
        />
        <div
            x-data="{
                toggleCreate: () => {
                    document.getElementById('user-login').classList.remove('hidden');
                    document.getElementById('user-create').classList.add('hidden');
                    document.querySelector('p.name-error').innerHTML = '';
                    document.querySelector('p.email-error').innerHTML = '';
                    document.querySelector('p.password-error').innerHTML = '';
                    document.querySelector('p.login-error').innerHTML = '';
                    document.getElementById('user-form-create').reset();
                },
            }"
            class="flex items-center justify-between mt-6"
        >
            <x-link-toggle
                :text="'Back to login'"
                :click="'toggleCreate'"
            />
            <x-submit
                :text="'Create'"
                :buttonId="'user-button-submit-create'"
                :svgId="'user-process-circle-create'"
            />
        </div>
    </form>
</div>