<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dojo extends Model
{
    protected $fillable = ['name', 'description'];

    // Relationship: one dojo has many ninjas
    public function ninjas()
    {
        return $this->hasMany(Ninja::class);
    }
}
