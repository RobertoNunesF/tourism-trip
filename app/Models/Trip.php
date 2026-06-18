<?php

namespace App\Models;

use App\Observers\LogsCreationToJson;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(LogsCreationToJson::class)]
class Trip extends Model
{
    protected $fillable = [
        'origin', 
        'destination',
        'departure_time',
        'arrival_time',
        'vehicle_id',
        'driver_id'
    ];

    protected function casts(): array
    {
        return [
            'departure_time' => 'datetime',
            'arrival_time' => 'datetime',
        ];
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}