<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = [
        'hash',
        'type',
        'letter_code',
        'number_code',
    ];

}
