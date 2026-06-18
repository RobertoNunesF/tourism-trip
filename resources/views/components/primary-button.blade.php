<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex items-center justify-center px-4 py-3 bg-coinpel border border-transparent rounded-md font-semibold text-sm text-white tracking-wide hover:bg-coinpel-dark focus:outline-none focus:ring-2 focus:ring-coinpel-light focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>