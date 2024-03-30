<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Earning extends Model
{
    use HasFactory;

    protected $casts = [
        'flight_pay' => MoneyCast::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('owner', function (Builder $builder) {
            $builder->whereHas('report', function ($query) {
                $query->where('user_id', Auth::id());
            });
        });
        
        static::created(function (Earning $earning) {
            $earning->update([
                'total_compensation' => $earning->flight_pay + $earning->profit_sharing + $earning->employer_retirement_contribution + $earning->employer_health_savings_contribution
            ]);
        });
    }

    public function report() : BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function user() : HasOneThrough
    {
        return $this->hasOneThrough(User::class, Report::class, 'id', 'id');
    }
}
