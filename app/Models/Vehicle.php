<?php

namespace App\Models;

use App\Observers\LogsCreationToJson;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(LogsCreationToJson::class)]
class Vehicle extends Model
{
    protected $fillable = ['plate', 'model', 'capacity'];

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}