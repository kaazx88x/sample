<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
   // protected $table = 'types';
    protected $fillable = [
        'name'
    ];

    // public function name()
    // {
    //     return $this->name; // Assuming "name" is a field in the Type model
    // }




}
