@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-orange-400 pooorborder-orange-600 text-sm font-medium leading-5 text-gray-900 pooortext-gray-100 focus:outline-none focus:border-orange-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 pooortext-gray-400 hover:text-gray-700 pooorhover:text-gray-300 hover:border-gray-300 pooorhover:border-gray-700 focus:outline-none focus:text-gray-700 pooorfocus:text-gray-300 focus:border-gray-300 pooorfocus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
