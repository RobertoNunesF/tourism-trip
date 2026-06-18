<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = ['plate', 'model', 'capacity'];

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
