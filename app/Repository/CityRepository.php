<?php

namespace App\Repository;

use App\Models\City;
use Cache;
use Carbon\Carbon;

class CityRepository
{
    public function getCity($cityUrl)
    {

        $expire = Carbon::now()->addHours(1200);

        $city = Cache::remember('city_' . $cityUrl, $expire, function () use ($cityUrl) {

            return City::whereUrl($cityUrl)->first();

        });

        return $city;
    }

    /**
     * @param $id
     * @return City
     */
    public function getAllCityInfoById($id)
    {

        $expire = Carbon::now()->addMinutes(1000);

        $data = Cache::remember('city_id_'.$id, $expire, function() use ($id) {

            return  City::where(['id' => $id])
                ->with(['info' => function ($query) {
                    $query->where('site_id', SITE_ID);
                }])
                ->get()
                ->first();

        });

        return $data;
    }

}
