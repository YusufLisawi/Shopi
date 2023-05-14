<?php

namespace App\Http\Livewire;

use App\Mail\OrderReceived;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\InvoiceService;
use Livewire\Component;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Checkout extends Component
{

    public function stripeCheckout()
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

        $total = str_replace(',', '', Cart::total());
        $order = new Order([
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'total' => $total,
            'session_id' => $checkout_session->id,
        ]);
        $order->save();

        foreach (Cart::content() as $item) {
            $price = str_replace(',', '', $item->price);
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
                'price' => $price
            ]);
            $orderItem->save();
        }

        return $checkout_session->url;
    }

    public function success(Request $request, InvoiceService $invoiceService)
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
            Mail::to($order->user->email)->send(new OrderReceived($order, $invoiceService->createInvoice($order)));
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
            'phone' => 'required',
            'zipcode' => 'required|numeric',
            'order_notes' => '',
        ]);

        $user = Auth::user();
        if ($user->billingDetails === null) {
            $user->billingDetails()->create($validatedRequest);
        } else {
            $user->billingDetails()->update($validatedRequest);
        }

        $sessionUrl = $this->stripeCheckout();


        return redirect($sessionUrl);
    }

    public function render()
    {
        if (Cart::count() <= 0) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('home');
        }
        $user = Auth::user();
        $billingDetails = $user->billingDetails;
        return view('livewire.checkout', compact('billingDetails'));
    }
}
