<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Affiliate extends Model
{
    protected $table = 'affiliate';

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }


    use HasFactory;
}
