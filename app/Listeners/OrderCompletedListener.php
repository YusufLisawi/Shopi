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
        dd('chi la3a');
        // Check if the saved model is an Order instance and the status has been updated to "completed"
        if ($event->model instanceof Order && $event->model->wasChanged('status') && $event->model->status === 'completed') {
            $user = $event->model->user;
            // Send email to the user using a Mailable class
            Mail::to($user->email)->send(new OrderCompletedMail($event->model));
        }
    }
}
