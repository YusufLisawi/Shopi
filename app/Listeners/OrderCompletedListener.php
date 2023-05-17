<?php

namespace App\Listeners;

use App\Events\OrderStatusChanged;
use App\Models\Order;
use App\Mail\OrderCompletedMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Events\ModelSaved;

class OrderCompletedListener
{
    use InteractsWithQueue;

    public function handle(OrderStatusChanged $event)
    {
        if ($event->order->status === 'completed') {
            $user = $event->order->user;
            Mail::to($user->email)->send(new OrderCompletedMail($event->order));
        }
    }
}
