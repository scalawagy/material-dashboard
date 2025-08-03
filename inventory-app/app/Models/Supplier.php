<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'address',
    ];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function supplies()
    {
        return $this->hasMany(Supply::class);
    }
}

