@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 pooorborder-gray-700 pooorbg-gray-900 pooortext-gray-300 focus:border-orange-500 pooorfocus:border-orange-600 focus:ring-orange-500 pooorfocus:ring-orange-600 rounded-md shadow-sm']) !!}>
