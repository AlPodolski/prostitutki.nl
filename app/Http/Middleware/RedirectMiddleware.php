<?php

namespace App\Http\Middleware;

use App\Models\City;
use Cache;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use App\Models\Redirect;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $actualCity =  $request->route('city');

        if ($actualCity){

            $expire = Carbon::now()->addHours(24);

            $redirect = Cache::remember('redirect_' . $actualCity.'_'.SITE, $expire, function () use ($actualCity) {

                $redirect = Redirect::where('from', $actualCity)->where('site', SITE)->first();

                if ($redirect) return $redirect;

                return false;

            });

            if ($redirect){

                $url = 'https://'.$redirect->to.'.'.SITE.$_SERVER['REQUEST_URI'];

                header('Location: '.$url, true, 301);

                exit();

            }

            $city = preg_replace('/[0-9]+/', '', $actualCity) ;

            $request->route()->setParameter('city', $city);

        }

        $actualCity = preg_replace("/[0-9]/", '', $actualCity);

        $cityInfo = \Cache::get('city_info-'.$actualCity.'-'.'-site_id-'.SITE);

        if (!$cityInfo){

            $cityInfo = City::where('url', $actualCity)
                ->with(['info' => function ($query) {
                    $query->where('site_id', SITE_ID);
                }])
                ->first();

            \Cache::set('city_info-'.$actualCity.'-'.'-site_id-'.SITE, $cityInfo);

        }

        if ($cityInfo and isset($cityInfo->info)){

            $actualHost = $cityInfo->info->actual_city.'.'.$cityInfo->info->domain;

            if ($actualHost != $_SERVER['HTTP_HOST']) {

                $url = 'https://'.$actualHost.$_SERVER['REQUEST_URI'];

                //header('Location: '.$url, true, 301);

                //exit();

            }
        }

        return $next($request);
    }
}
