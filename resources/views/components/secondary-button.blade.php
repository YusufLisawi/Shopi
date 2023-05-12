<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-black px-5 py-2 text-white font-medium rounded-3xl ml-2']) }}>
    {{ $slot }}
</button>
