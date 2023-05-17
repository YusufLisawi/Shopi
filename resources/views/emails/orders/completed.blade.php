<x-mail::message>
# Your order has been completed

Your order #{{ $order->id }} has been shipped.

Thank you for your purchase!

<a href="{{ url('/dashboard') }}" style="background-color: #ed8936; color: #ffffff; font-weight: bold; text-decoration: none; padding: 12px 24px; border-radius: 4px; display: inline-block;">View Your Order</a>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
