<?php

namespace App\Models;

use App\Observers\LogsCreationToJson;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(LogsCreationToJson::class)]
class Driver extends Model
{
    protected $fillable = ['name', 'cnh_number', 'phone'];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}