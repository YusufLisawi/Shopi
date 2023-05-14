<x-mail::message>
    <div style="background-color: #f7fafc; ">
        <div style="background-color: #ffffff; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 4px; overflow: hidden;">
            <div style="padding: 20px;">
                <h1 style="font-size: 24px; font-weight: bold; color: #ed8936; margin-bottom: 16px;">Thank You for Your Purchase!</h1>
                <h3>Order: #{{$order->id}}</h3>
                <p style="color: #4a5568; margin-bottom: 16px;">
                    We've received your order and it's being processed. You'll receive a confirmation email with your order details shortly.
                </p>
                <p style="color: #4a5568; margin-bottom: 16px;">
                    If you have any questions or need assistance, please don't hesitate to contact our support team.
                </p>
                <a href="{{ url('/dashboard') }}" style="background-color: #ed8936; color: #ffffff; font-weight: bold; text-decoration: none; padding: 12px 24px; border-radius: 4px; display: inline-block;">View Your Order</a>
            </div>
            <div style="background-color: #f7fafc; padding: 10px; border-raduis: 10px; display: flex; justify-content: space-between; align-items: center;">
                <p style="color: #4a5568;">
                    Thanks, {{$order->user->name}}<br>
                    {{ config('app.name') }}
                </p>
            </div>
            <a href="#" style="color: #ed8936; text-decoration: none;">Shopi Contact Support</a>
        </div>
    </div>
</x-mail::message>
