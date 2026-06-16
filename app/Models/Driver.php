<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
