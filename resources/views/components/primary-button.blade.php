<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn inline-flex items-center justify-center rounded-xl border border-transparent bg-teal-600 px-4 py-2 font-semibold text-xs uppercase tracking-wider text-white shadow-sm hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 disabled:opacity-40']) }}>
    {{ $slot }}
</button>
