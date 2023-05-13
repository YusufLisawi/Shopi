<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Checkout extends Component
{

    public function stripeCheckout($details)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $lineItems = [];
        foreach (Cart::content() as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->model->name,
                    ],
                    'unit_amount' => $item->model->price * 100,
                ],
                'quantity' => $item->qty,
            ];
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success')."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel'),
        ]);


        $order = new Order([
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'total' => Cart::total(),
            'country' => $details['country'],
            'billing_address' => $details['billing_address'],
            'city' => $details['city'],
            'state' => $details['state'],
            'zipcode' => $details['zipcode'],
            'order_notes' => $details['notes'] ?? null,
            'session_id' => $checkout_session->id,
        ]);
        $order->save();

        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'price' => $item->price
            ]);
            $orderItem->save();
        }

        return $checkout_session->url;
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException();
            }
            $order = Order::where('session_id', $session->id)->first();
            $customer = \Stripe\Customer::retrieve($session->customer);
            if ($order->status === 'pending') {
                $order->status = 'processing';
                $order->save();
            }
            Cart::destroy();
            return view('livewire.success', compact('customer'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            throw new NotFoundHttpException();
        }
        return redirect()->route('home');
    }

    public function cancel()
    {
        return redirect()->route('home')->with('success', 'Your order has been canceled.');
    }

    public function makeOrder(Request $request)
    {
        $validatedRequest = $request->validate([
            'country' => 'required',
            'billing_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required|numeric',
        ]);
        $sessionUrl = $this->stripeCheckout($validatedRequest);

        return redirect($sessionUrl);
    }

    public function render()
    {
        if (Cart::count() <= 0) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('home');
        }
        return view('livewire.checkout');
    }
}
