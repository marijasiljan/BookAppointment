<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{


    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class);
    }

    use HasFactory;
}
