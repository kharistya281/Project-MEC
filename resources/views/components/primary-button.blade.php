<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block rounded-2xl border border-violet-800 bg-purple-500 px-5 py-2 text-center font-medium text-white hover:bg-purple-400 mt-3 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
