@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-text-link nav-text-link-active'
            : 'nav-text-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
