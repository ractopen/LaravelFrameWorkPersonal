<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ninja extends Model
{
    protected $fillable = ['name', 'skill', 'bio', 'dojo_id'];

    // Relationship: many ninjas belong to one dojo
    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }
}
