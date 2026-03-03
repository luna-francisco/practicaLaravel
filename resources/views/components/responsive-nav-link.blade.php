@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-xl px-4 py-2 text-start text-base font-semibold text-slate-900 bg-slate-100/80'
            : 'block w-full rounded-xl px-4 py-2 text-start text-base font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100/70';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
