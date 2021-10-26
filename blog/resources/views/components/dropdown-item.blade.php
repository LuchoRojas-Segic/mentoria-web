@props(['actived' => false])
@php

$clases = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 hover:text-white';

if ($actived) {
    $clases .= 'bg-blue-500 text-white';
}

@endphp

<a {{ $attributes(['class' => $classes])}}>
    {{ $slot }}
</a>   