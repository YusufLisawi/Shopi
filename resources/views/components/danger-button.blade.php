<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger']) }}>
    {{ $slot }}
</button>
