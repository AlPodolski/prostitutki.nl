<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repository\DataRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{

    private $postRepository;
    private $cityRepository;

    public function __construct()
    {
        $this->cityRepository = new \App\Repository\CityRepository();
        $this->dataRepository = new DataRepository();

        parent::__construct();
    }

    public function index(Request $request)
    {
        $cityId = $request->post('city');

        $cityInfo = $this->cityRepository->getAllCityInfoById($cityId);

        $domain = $cityInfo->info->domain;

        $post = Post::where(['fake' => Post::POST_REAL, 'city_id' => $cityInfo->id])
            ->inRandomOrder()
            ->first();

        if (!$post){

            $post = Post::where(['city_id' => $cityInfo->id])
                ->inRandomOrder()
                ->first();

        }

        if ($post){

            $result = [
                'name' => $post->name,
                'age' => $post->age,
                'url' => 'https://' . $cityInfo->info->actual_city . '.'.$domain.'/post/' . $post->url,
                'photo' => 'https://' . $cityInfo->info->actual_city . '.' . $domain . '/521-741/thumbs'.$post->avatar
            ];

            echo json_encode($result);

        }

        die();

    }
}
