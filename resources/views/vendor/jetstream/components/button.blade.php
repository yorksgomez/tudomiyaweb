<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex text-center min-w-[8rem] justify-center items-center px-4 py-2 bg-main-gradient rounded-2xl font-semibold text-xs text-white tracking-widest focus:outline-none disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
