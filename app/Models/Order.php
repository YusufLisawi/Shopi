<?php

namespace App\Models;

use App\Listeners\OrderCompletedListener;
use App\Mail\OrderCompletedMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status', 'total', 'country',
        'billing_address',
        'city',
        'state',
        'zipcode',
        'order_notes',
        'session_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
        'updated' => OrderCompletedListener::class,
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
