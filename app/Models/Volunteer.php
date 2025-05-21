<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $table = "volunteers";
    protected $fillable = [
        'name',
        'email',
        'number_phone',
        'voluntrip_id',
        'is_verified',
        'verify_token',
        'volunteer_payments_id',
    ];

    public function voluntrip()
    {
        return $this->belongsTo(Voluntrip::class);
    }

    public function payment()
    {
        return $this->belongsTo(VolunteerPayment::class, 'volunteer_payments_id');
    }
}
