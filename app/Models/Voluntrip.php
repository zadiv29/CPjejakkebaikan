<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voluntrip extends Model
{
    protected $table = "voluntrip";

    protected $fillable = [
        "slug",
        "thumbnail",
        "name",
        "about",
        "target_amount",
        "start_date",
        "start_time",
        "end_time",
        "is_active",
        "fundraiser_id",
        "ticket_price",
    ];

    public function fundraiser(): BelongsTo
    {
        return $this->belongsTo(Fundraiser::class, 'fundraiser_id');
    }
}
