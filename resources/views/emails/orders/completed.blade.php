<x-mail::message>
# Your order has been completed

Your order #{{ $order->id }} has been shipped.

Thank you for your purchase!

<x-mail::button :url="{{ url('/dashboard') }}">
Track Order
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
