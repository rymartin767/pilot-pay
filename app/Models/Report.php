<?php

namespace App\Models;

use App\Models\User;
use App\Models\Earning;
use App\Enums\ReportFleets;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $casts = [
        'fleet' => ReportFleets::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('owner', function (Builder $builder) {
            $builder->where('user_id',  Auth::id());
        });
        
        static::creating(function (Report $report) {
            $report->slug = Str::of($report->wage_year . '-' . $report->user->name . '-' . $report->employer)->slug();
            $report->employer_logo_url = 'logos/' . Str::of($report->employer)->slug() . '-300.webp';
        });
    }

    public function path() : string
    {
        return 'reports/' . $this->slug;
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function earnings() : HasOne
    {
        return $this->hasOne(Earning::class)->withoutGlobalScopes();
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
