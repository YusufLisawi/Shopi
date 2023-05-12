<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-red-400 px-5 py-2 text-white font-medium rounded-3xl ml-2']) }}>
    {{ $slot }}
</button>
