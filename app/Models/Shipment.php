<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'sample_id',
        'customer_id',
        'courier'
    ];

    public function sample() {
        return $this->belongsTo(Sample::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    public function feedback(): MorphMany
    {
        return $this->morphMany(Feedback::class, 'feedbackable');
    }
}
