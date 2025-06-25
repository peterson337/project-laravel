@props(['active', 'type'])

@php
$classes = 'text-2xl inline-flex items-center px-1 pt-1  text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'

@endphp

<h3 {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</h3>
