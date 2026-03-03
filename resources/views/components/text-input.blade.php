@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'pro-input rounded-xl border px-3 py-2 shadow-sm focus:border-blue-500 focus:ring-blue-500']) }}
>
