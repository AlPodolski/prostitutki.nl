<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{

    public $timestamps = false;

    public $fillable = ['from', 'to', 'site'];

}
