<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voluntrip extends Model
{
    use SoftDeletes;

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

    public function volunteers()
    {
        return $this->hasMany(Volunteer::class);
    }
}
