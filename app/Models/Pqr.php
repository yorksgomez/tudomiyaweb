<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pqr extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'type',
        'email',
        'information',
        'state',
        'embed'
    ];

}
