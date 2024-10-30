<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    const OBMENKA = 1;

    const BETAT = 2;

    protected $fillable = [
        'name',
        'value',
    ];
}
