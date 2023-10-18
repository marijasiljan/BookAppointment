<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingTime extends Model
{
    protected $table = 'booking_time';

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    use HasFactory;
}
