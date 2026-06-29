<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'photo',
    ];

    protected static function booted()
    {
        static::creating(function ($city) {
            $city->slug = Str::slug($city->name);
        });

        static::updating(function ($city) {
            $city->slug = Str::slug($city->name);
        });
    }
}