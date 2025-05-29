<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

    protected $fillable = [
        "volunteer_id",
        "uuid",
        "merchant_trx_id",
        "amount",
        "payment_method",
        "payment_channel",
        "va_number",
        "expired_at",
        "status",
        "payment_type",
        "callback_payload",
    ];

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class, 'volunteer_payments_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
