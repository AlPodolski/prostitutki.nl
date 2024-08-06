<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActualCityInfo extends Model
{
    public function city(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
