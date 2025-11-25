<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image_path',
        'stock',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Cascade soft delete for related cart_items and their carts
    protected static function booted()
    {
        static::deleting(function ($item) {
            if (!$item->isForceDeleting()) {
                $item->cartItems()->each(function ($cartItem) {
                    $cartItem->delete();
                    // Cascade to cart
                    $cart = $cartItem->cart;
                    if ($cart && !$cart->trashed()) {
                        $cart->delete();
                    }
                });
            }
        });
    }
}
