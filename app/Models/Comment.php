<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $with = ['user'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function report() : BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
}
