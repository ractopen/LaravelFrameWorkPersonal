<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'cart_items')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Cascade soft delete for related cart_items and their items
    protected static function booted()
    {
        static::deleting(function ($cart) {
            if (!$cart->isForceDeleting()) {
                $cart->cartItems()->each(function ($cartItem) {
                    $cartItem->delete();
                    // Cascade to item
                    $item = $cartItem->item;
                    if ($item && !$item->trashed()) {
                        $item->delete();
                    }
                });
            }
        });
    }
}
