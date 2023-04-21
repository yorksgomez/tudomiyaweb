<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'information',
        'customer_id',
        'domi_id',
        'state',
        'service_type',
        'service_id'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function domi() {
        return $this->belongsTo(Domi::class);
    }

}
