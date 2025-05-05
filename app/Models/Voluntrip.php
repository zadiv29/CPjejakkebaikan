<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voluntrip extends Model
{
    protected $table = "voluntrip";

    protected $fillable = [
        "thumbnail",
        "name",
        "start_date",
        "start_time",
        "end_time",
        "total_ticket",
        "about",
        "is_active",
        "fundraiser_id",
        "slug",
        "ticket_price",
        "event_status",
    ];

    public function fundraiser(): BelongsTo
    {
        return $this->belongsTo(Fundraiser::class, 'fundraiser_id');
    }
}
