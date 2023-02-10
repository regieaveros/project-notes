<label class="relative inline-flex items-center cursor-pointer">
    <input
        x-data="{
            btnToggleCheck: () => {
                const toggle = document.querySelector('input[type=checkbox]');

                if(toggle.checked === true) {
                    document.querySelector('input[name=password]').disabled = false;
                    document.querySelector('input[name=password_confirmation]').disabled = false;
                } else {
                    document.querySelector('input[name=password]').disabled = true;
                    document.querySelector('input[name=password_confirmation]').disabled = true;
                    document.querySelector('input[name=password]').value = '';
                    document.querySelector('input[name=password_confirmation]').value = '';
                    document.querySelector('p.password-error').innerHTML = '';
                }
            }
        }"
        x-init="
            document.querySelector('input[name=password]').disabled = true;
            document.querySelector('input[name=password_confirmation]').disabled = true; 
        "
        @change="btnToggleCheck"
        type="checkbox" 
        name="toggle" 
        value="checked" 
        class="sr-only peer"
    >
    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-cyan-500"></div>
</label>