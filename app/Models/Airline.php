<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (Airline $airline) {
            
            $airline->image_url = 'images/' . $airline->icao . '.webp';
        });
    }
}
