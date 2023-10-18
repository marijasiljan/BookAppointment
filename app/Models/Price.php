<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Price extends Model
{
    protected $table = 'price';

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }


    use HasFactory;
}
