@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 pooortext-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
