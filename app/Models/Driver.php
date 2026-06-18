<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['name', 'cnh_number', 'phone'];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}