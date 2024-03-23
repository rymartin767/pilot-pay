<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Earning extends Model
{
    use HasFactory;

    protected $casts = [
        'flight_pay' => MoneyCast::class,
    ];

    public function report() : BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function user() : HasOneThrough
    {
        return $this->hasOneThrough(User::class, Report::class, 'id', 'id');
    }
}
