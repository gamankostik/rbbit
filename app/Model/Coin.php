<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    const TYPE = ['btc', 'usdt', 'eth'];

    protected $fillable = [
        'number',
        'hash',
        'type',
        'amount',
        'enabled'
    ];
}
