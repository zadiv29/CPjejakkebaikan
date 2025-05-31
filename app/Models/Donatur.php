<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donatur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'notes',
        'fundraising_id',
        'phone_number',
        'email',
        'is_paid',
        'donation_payments_id',
        'verify_token'
    ];

    public function fundraising()
    {
        return $this->belongsTo(Fundraising::class);
    }
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
