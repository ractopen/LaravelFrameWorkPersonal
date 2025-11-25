<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, \Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_admin',
        'theme',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Cascade soft delete for related carts and their items
    protected static function booted()
    {
        static::deleting(function ($user) {
            if (!$user->isForceDeleting()) {
                $user->carts()->each(function ($cart) {
                    $cart->delete();
                    // Cascade to cart items
                    $cart->cartItems()->each(function ($cartItem) {
                        $cartItem->delete();
                        // Cascade to item
                        $item = $cartItem->item;
                        if ($item && !$item->trashed()) {
                            $item->delete();
                        }
                    });
                });
            }
        });
    }
}
