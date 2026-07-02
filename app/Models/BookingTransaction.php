<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\OfficeSpace;

class BookingTransaction extends Model
{
    protected $fillable = [
        'name',
        'booking_trx_id',
        'phone_number',
        'total_amount',
        'duration',
        'started_at',
        'ended_at',
        'is_paid',
        'office_space_id',
    ];

    public function officeSpace(): BelongsTo
    {
        return $this->belongsTo(OfficeSpace::class);
    }
}