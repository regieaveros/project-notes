<nav 
    
    class="bg-cyan-800 fixed w-full z-20 top-0 left-0 border-cyan-200 px-3 py-2.5 text-white"
>
    <div class="container relative mx-auto flex flex-wrap justify-between items-center">
        <span class="self-center text-xl font-semibold whitespace-nowrap">
            Notes
        </span>
        <div class="flex flex-wrap items-center">
            <button
                x-data="{
                    btnToggle: () => {
                        document.getElementById('toggle-dark-icon').classList.toggle('hidden');
                        document.getElementById('toggle-light-icon').classList.toggle('hidden');
                        if (localStorage.getItem('color-theme')) {
                            if (localStorage.getItem('color-theme') === 'light') {
                                document.documentElement.classList.add('dark');
                                localStorage.setItem('color-theme', 'dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                                localStorage.setItem('color-theme', 'light');
                            }
                        } else {
                            if (document.documentElement.classList.contains('dark')) {
                                document.documentElement.classList.remove('dark');
                                localStorage.setItem('color-theme', 'light');
                            } else {
                                document.documentElement.classList.add('dark');
                                localStorage.setItem('color-theme', 'dark');
                            }
                        }
                    },
                }"
                x-init="
                    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        document.getElementById('toggle-dark-icon').classList.remove('hidden');
                    } else {
                        document.getElementById('toggle-light-icon').classList.remove('hidden');
                    }
                "
                class="text-[1.6rem] mr-8"
                @click="btnToggle"
            >   
                <span id="toggle-light-icon" class="hidden">
                    <i class="fa-solid fa-cloud-sun text-amber-300 hover:text-amber-400"></i>
                </span>
                <span id="toggle-dark-icon" class="hidden">
                    <i class="fa-solid fa-cloud-moon text-gray-50 hover:text-gray-100"></i>
                </span>
            </button>
            <button
                @click="
                btnOpen = !btnOpen; 
                $nextTick(() => {
                    document.querySelector('.tham').classList.toggle('tham-active');
                    document.getElementById('navigation_mask').classList.toggle('hidden');
                    document.body.classList.toggle('overflow-hidden');
                    document.querySelector('p.name-error').innerHTML = '';
                    document.querySelector('p.email-error').innerHTML = '';
                    document.querySelector('p.password-error').innerHTML = '';
                    @auth
                    document.getElementById('auth-navigation').classList.remove('hidden');
                    document.getElementById('user-profile').classList.add('hidden');
                    document.getElementById('add-note').classList.add('hidden');
                    document.getElementById('edit-note').classList.add('hidden');
                    document.querySelector('input[type=checkbox]').checked = false;
                    document.querySelector('input[name=password]').disabled = true;
                    document.querySelector('input[name=password_confirmation]').disabled = true;
                    document.querySelector('input[name=password]').value = '';
                    document.querySelector('input[name=password_confirmation]').value = '';
                    document.querySelector('input[name=name]').value = '{{session('name')}}';
                    document.querySelector('input[name=email]').value = '{{session('email')}}';
                    document.getElementById('imageSrc').style.backgroundImage = 'url(@if(!empty(session('profile'))) <?= asset('uploads/images/'.session('profile')) ?> @else https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png @endif)';
                    document.querySelector('input[type=file]').value = '';
                    document.getElementById('note-form-create').reset();
                    document.querySelector('p.title-error').innerHTML = '';
                    document.querySelector('p.message-error').innerHTML = '';
                    @else
                    document.getElementById('user-form-login').reset();
                    document.getElementById('user-form-create').reset();
                    document.querySelector('p.login-error').innerHTML = '';
                    @endauth
                });"
                class="tham tham-e-spin tham-w-8"
            >
                <div class="tham-box">
                    <div class="tham-inner bg-slate-800" />
                </div>
            </button>  
        </div>
        <template x-if="true">
            <div
                x-show="btnOpen"
                x-transition:enter="transition duration-300"
                x-transition:enter-start="transform translate-x-full"
                x-transition:enter-end="transform translate-x-0"
                x-transition:leave="transition duration-300"
                x-transition:leave-start="transform"
                x-transition:leave-end="transform -translate-x-[-1000px]"
                class="absolute top-[52px] right-0 z-20 @guest w-full max-w-[25rem] @endguest transition-all duration-300 bg-slate-50 dark:bg-slate-600 border-1 border-gray-300 shadow" 
            >
                <x-nav-items />
            </div>
        </template>
    </div>
</nav>