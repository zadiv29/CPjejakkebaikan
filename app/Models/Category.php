<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    public function fundraisings()
    {
        return $this->hasMany(Fundraising::class);
    }

    public function activeFundraisings() // <-- Nama relasi baru
    {
        return $this->hasMany(Fundraising::class)->where('is_active', true);
    }
}
