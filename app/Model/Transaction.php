<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'address_from',
        'type',
        'address_to',
        'amount',
        'success',
        'message',
    ];

}
