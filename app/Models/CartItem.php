<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'item_id',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
