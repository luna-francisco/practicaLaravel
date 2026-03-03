<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2 font-semibold text-xs uppercase tracking-wider text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 disabled:opacity-40']) }}>
    {{ $slot }}
</button>
