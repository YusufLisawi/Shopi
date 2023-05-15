<?php

namespace App\Listeners;

use App\Models\Order;
use App\Mail\OrderCompletedMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Events\ModelSaved;
// app/Listeners/OrderCompletedListener.php
class OrderCompletedListener
{
    use InteractsWithQueue;

    public function handle(ModelSaved $event)
    {
        if ($event->model instanceof Order && $event->model->wasChanged('status') && $event->model->status === 'completed') {
            $user = $event->model->user;
            Mail::to($user->email)->send(new OrderCompletedMail($event->model));
        }
    }
}
