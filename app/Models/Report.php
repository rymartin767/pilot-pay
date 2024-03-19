<?php

namespace App\Models;

use App\Enums\ReportFleets;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $casts = [
        'fleet' => ReportFleets::class,
    ];

    protected static function booted(): void
    {
        // 1l3H7-nt4c-1-2023
        static::creating(function (Report $report) {
            $report->slug = Str::of(Str::random(5) . '-' . $report->user->name . '-' . $report->airline->id . '-' . $report->wage_year)->slug();
        });
    }

    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }

    public function airline() : Relation
    {
        return $this->belongsTo(Airline::class);
    }
}
