<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn inline-flex items-center justify-center rounded-xl border border-transparent bg-rose-600 px-4 py-2 font-semibold text-xs uppercase tracking-wider text-white shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 disabled:opacity-40']) }}>
    {{ $slot }}
</button>
