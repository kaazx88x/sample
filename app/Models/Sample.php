<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id',
        'image',
        'remark'
    ];

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
