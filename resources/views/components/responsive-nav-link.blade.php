@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-orange-400 pooorborder-orange-600 text-left text-base font-medium text-orange-700 pooortext-orange-300 bg-orange-50 pooorbg-orange-900/50 focus:outline-none focus:text-orange-800 pooorfocus:text-orange-200 focus:bg-orange-100 pooorfocus:bg-orange-900 focus:border-orange-700 pooorfocus:border-orange-300 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 pooortext-gray-400 hover:text-gray-800 pooorhover:text-gray-200 hover:bg-gray-50 pooorhover:bg-gray-700 hover:border-gray-300 pooorhover:border-gray-600 focus:outline-none focus:text-gray-800 pooorfocus:text-gray-200 focus:bg-gray-50 pooorfocus:bg-gray-700 focus:border-gray-300 pooorfocus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
