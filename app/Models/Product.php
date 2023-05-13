<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brief_description',
        'description',
        'price',
        'old_price',
        'SKU',
        'stock_status',
        'quantity',
        'image',
        'images',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
