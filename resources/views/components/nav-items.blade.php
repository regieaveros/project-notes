@auth
<ul id="auth-navigation" class="flex flex-col text-md">
    <li class="flex items-center p-4">
        <div class="bg-cover bg-center w-9 h-9 rounded-full bg-no-repeat ring-2 ring-gray-400 ring-offset-1" style="background-image: url(@if(!empty(session('profile')))'<?= asset('uploads/images/'.session('profile')) ?>'@else 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' @endif);"></div>
        <div class="ml-3">
            <h4 class="text-lg font-bold transition-all duration-300 text-gray-800 dark:text-gray-100">
                @if(session()->has('name'))
                    {{session('name')}}
                @endif
            </h4>
            <p class="text-md text-italic transition-all duration-300 text-gray-800 dark:text-gray-100 mt-[-5px]">
                @if(session()->has('email'))
                    {{session('email')}}
                @endif
            </p>
        </div>
    </li>
    <li class="border-t-[1px] border-gray-200 dark:border-slate-500">
        <button
            x-data="{
                btnProfile: () => {
                    document.getElementById('auth-navigation').classList.add('hidden');
                    document.getElementById('user-profile').classList.remove('hidden');
                }
            }"
            @click="btnProfile"
            class="inline-block align-baseline text-left transition-all duration-100 text-gray-800 dark:text-gray-100 focus:outline-none hover:bg-[#d0d0d029] focus:ring-2 focus:ring-slate-300 py-3 pl-4 w-60"
        >
            <i class="fa-regular fa-user text-[16px] pr-2"></i>
            Profile
        </button>
    </li>
    <li class="border-y-[1px] border-gray-200 dark:border-slate-500">
        <button
            x-data="{
                btnAddNote: () => {
                    document.getElementById('auth-navigation').classList.add('hidden');
                    document.getElementById('add-note').classList.remove('hidden');
                }
            }"
            @click="btnAddNote"
            class="inline-block align-baseline text-left transition-all duration-100 text-gray-800 dark:text-gray-100 focus:outline-none hover:bg-[#d0d0d029] focus:ring-2 focus:ring-slate-300 py-3 pl-4 w-60"
        >
            <i class="fa-regular fa-note-sticky text-[16px] pr-2"></i>
            Add New Note
        </button>
    </li>
    <li>
        <form id="user-logout" action="{{route('user.logout')}}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{session('userid')}}">
            <input type="hidden" name="updated_at" value="{{session('updated_at')}}">
            <button class="inline-block align-baseline text-left transition-all duration-100 text-gray-800 dark:text-gray-100 focus:outline-none hover:bg-[#d0d0d029] focus:ring-2 focus:ring-slate-300 py-3 pl-4 w-60">
                <i class="fa-solid fa-arrow-right-from-bracket text-[16px] pr-2"></i>
                Logout
            </button>
        </form>
    </li>
</ul>
@include('users.edit')
@include('notes.add')
@include('notes.edit')
@else
    @include('users.login')
    @include('users.create')
@endauth
