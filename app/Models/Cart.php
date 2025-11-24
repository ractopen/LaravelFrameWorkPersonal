<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

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
}
