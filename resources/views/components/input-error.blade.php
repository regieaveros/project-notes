<div class="mb-3">
    <label class="block transition-all duration-300 text-gray-700 dark:text-gray-100 text-sm font-bold mb-2" for="{{ $name }}">
       {{ $label }}
    </label>
    <input class="transition-all duration-300 dark:bg-slate-300 dark:border-slate-300 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $class }}" type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}" autocomplete="off">
    <p class="text-red-500 dark:text-red-400 font-semibold text-xs italic mt-1 {{ $name }}-error"></p>
</div>