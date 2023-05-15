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
        'session_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
        'saved' => OrderCompletedListener::class,
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
