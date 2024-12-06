<?php

namespace App\Http\Controllers\Admin;

use App\Actions\AddToCloud;
use App\Http\Controllers\Controller;
use App\Models\ActualCityInfo;
use App\Models\CloudZone;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index()
    {
        $redirects = Redirect::orderByDesc('id')->paginate(40);

        return view('admin.redirect.index', compact('redirects'));
    }

    public function create()
    {

        $domains = ActualCityInfo::select('domain', \DB::raw('MAX(id) as id'))
                ->groupBy('domain')
                ->get();

        return view('admin.redirect.create', compact('domains'));
    }

    public function store(Request $request)
    {
        if ($redirect = Redirect::create($request->post())) {

            $cloudZone = CloudZone::where('site_id', SITE_ID)->first();

            if ($cloudZone){

                $zone = $cloudZone->zone;

                (new AddToCloud)->add(env('IP'), $zone, $redirect->to, env('CLOUD_API'), env('CLOUD_EMAIL'));

                \Cache::delete('redirect_' . $redirect->from.'_'.SITE);

            }

            $msg = 'Готово';

        }else{

            $msg = 'Ошибка';

        }

        return back()
            ->with(['msg' => $msg]);

    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
