<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(vehicle::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTO(Driver::class);
    }
}
