{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 pooorbg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white pooortext-gray-800 uppercase tracking-widest hover:bg-gray-700 pooorhover:bg-white focus:bg-gray-700 pooorfocus:bg-white active:bg-gray-900 poooractive:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 pooorfocus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-md btn-default']) }}>
    {{ $slot }}
</button>
