{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-orange-500 px-5 py-2 text-white font-medium rounded-3xl ml-2']) }}>
    {{ $slot }}
</button> --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-md btn-default']) }}>
    {{ $slot }}
</button>
