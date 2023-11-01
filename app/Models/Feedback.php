<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'remark'
    ];

    public function feedbackable(): MorphTo
    {
        return $this->morphTo();
    }
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

}
