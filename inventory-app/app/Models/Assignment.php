<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assignable_type',
        'assignable_id',
        'condition',
        'signed_off_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignable()
    {
        return $this->morphTo();
    }
}

