<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Photo;
use App\Models\PostMetro;
use App\Models\PostPlace;
use App\Models\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

    }

    public function create($city)
    {
        $cityInfo = $this->cityRepository->getCity($city);
        $data = $this->dataRepository->getData($cityInfo['id']);

        return view(PATH . '.cabinet.post.add', compact('data'));
    }

    public function store(Request $request)
    {

        $post = new Post();

        $post->site_id = SITE_ID;
        $post->user_id = auth()->id();
        $post->fake = Post::POST_REAL;
        $post->publication_status = Post::POST_ON_MODERATION;

        $post->fill($request->post());

        if ($post->save()) {

            $post->url = \Str::slug($post->name . '-') . $post->id;

            $dir = \substr(\md5($post->url), 0, 3);

            $photo = array();

            if ($request->file('anketPhotos')) foreach ($request->file('anketPhotos') as $item) {

                $photo[] = [
                    'posts_id' => $post->id,
                    'file' => '/' . $item->store('/uploads/' . $dir, 'public'),
                    'type' => Photo::GALLERY_TYPE
                ];

            }


            if ($request->file('anketSelfie')) foreach ($request->file('anketSelfie') as $item) {

                $photo[] = [
                    'posts_id' => $post->id,
                    'file' => '/' . $item->store('/uploads/' . $dir, 'public'),
                    'type' => Photo::SELPHI_TYPE
                ];

            }


            if ($request->file('anketCheckPhoto')) {

                $photo[] = [
                    'posts_id' => $post->id,
                    'file' => '/' . $request->file('anketCheckPhoto')->store('/uploads/' . $dir, 'public'),
                    'type' => Photo::CHECK_PHOTO_TYPE
                ];

            }

            if ($place = $request->post('place')) {

                foreach ($place as $placeItem) {

                    PostPlace::create([
                        'place_id' => $placeItem,
                        'posts_id' => $post->id,
                        'city_id' => $post->city_id
                    ]);

                }

            }

            if ($metroId = $request->post('metro')) {

                PostMetro::create([
                    'metros_id' => $metroId,
                    'posts_id' => $post->id,
                    'city_id' => $post->city_id
                ]);

            }

            foreach ($request->post() as $postServiceId => $postServiceValue) {

                if (strpos($postServiceId, 'service-') !== false) {

                    $serviceId = str_replace('service-', '', $postServiceId);

                    $serviceData = [
                        'posts_id' => $post->id,
                        'service_id' => $serviceId,
                        'city_id' => $post->city_id
                    ];

                    if ($postServiceValue == 2) {

                        $serviceData['sympathy'] = 1;

                    }

                    if ($postServiceValue == 3) {

                        $serviceData['pay'] = 1;

                    }

                    if ($postServiceValue == 4) {

                        $serviceData['not_available'] = 1;

                    }

                    PostService::create($serviceData);

                }

            }

            $avatar = $request->file('photo')->store('/uploads/' . $dir, 'public');

            $post->avatar = $avatar;

            if ($video = $request->file('anketVideo')) {

                $video = $video->store('/uploads/' . $dir, 'public');

                $post->video = $video;

            }

            if ($photo) foreach ($photo as $item) {
                Photo::create($item);
            }

            $post->save();

        }

        if ($request->post('add_more')) return redirect('/cabinet/post/create');

        return redirect('/cabinet');

    }

    public function show($id)
    {
    }

    public function edit($city, $id)
    {

        $post = Post::where('id', $id)
            ->with('metro', 'service', 'place', 'photo')->first();

        if (!$post) abort(404);

        $cityInfo = $this->cityRepository->getCity($city);
        $data = $this->dataRepository->getData($cityInfo['id']);

        return view(PATH . '.cabinet.post.edit', compact('data', 'post'));
    }

    public function update(Request $request,$city, $id)
    {

        $post = Post::where(['id' => $id, 'user_id' => auth()->id()])->first();

        if (!$post) abort(404);

        $post->fill($request->post());

        $dir = \substr(\md5($post->url), 0, 3);

        $photo = array();

        \DB::table('post_services')->where('posts_id', $post->id)->delete();

        foreach ($request->post() as $postServiceId => $postServiceValue) {

            if (strpos($postServiceId, 'service-') !== false) {

                $serviceId = str_replace('service-', '', $postServiceId);

                $serviceData = [
                    'posts_id' => $post->id,
                    'service_id' => $serviceId,
                    'city_id' => $post->city_id
                ];

                if ($postServiceValue == 2) {

                    $serviceData['sympathy'] = 1;

                }

                if ($postServiceValue == 3) {

                    $serviceData['pay'] = 1;

                }

                if ($postServiceValue == 4) {

                    $serviceData['not_available'] = 1;

                }

                PostService::create($serviceData);

            }

        }

        if ($place = $request->post('place')) {

            \DB::table('post_places')->where('posts_id', $post->id)->delete();

            foreach ($place as $placeItem) {

                PostPlace::create([
                    'place_id' => $placeItem,
                    'posts_id' => $post->id,
                    'city_id' => $post->city_id
                ]);

            }

        }

        if ($metroId = $request->post('metro')) {

            \DB::table('post_metros')->where('posts_id', $post->id)->delete();

            PostMetro::create([
                'metros_id' => $metroId,
                'posts_id' => $post->id,
                'city_id' => $post->city_id
            ]);

        }

        if ($request->file('anketPhotos')) foreach ($request->file('anketPhotos') as $item) {

            $photo[] = [
                'posts_id' => $post->id,
                'file' => '/' . $item->store('/uploads/' . $dir, 'public'),
                'type' => Photo::GALLERY_TYPE
            ];

        }

        if ($request->file('anketSelfie')) foreach ($request->file('anketSelfie') as $item) {

            $photo[] = [
                'posts_id' => $post->id,
                'file' => '/' . $item->store('/uploads/' . $dir, 'public'),
                'type' => Photo::SELPHI_TYPE
            ];

        }


        if ($request->file('anketCheckPhoto')) {

            $file = Photo::where(['posts_id' => $post->id, 'type' => Photo::CHECK_PHOTO_TYPE])->first();

            if ($file) {

                $path = (storage_path('app/public' . $file->file));

                if (file_exists($path)) {

                    unlink($path);

                }

                $file->delete();

            }

            $photo[] = [
                'posts_id' => $post->id,
                'file' => '/' . $request->file('anketCheckPhoto')->store('/uploads/' . $dir, 'public'),
                'type' => Photo::CHECK_PHOTO_TYPE
            ];

        }

        $avatar = $request->file('photo');

        if ($avatar) {

            $avatar = $avatar->store('/uploads/' . $dir, 'public');

            $path = (storage_path('app/public/' . $post->avatar));

            if (file_exists($path)) {

                unlink($path);

            }

            $post->avatar = $avatar;

        }

        if ($video = $request->file('anketVideo')) {

            if ($post->video){

                $path = (storage_path('app/public/' . $post->video));

                if (file_exists($path)) {

                    unlink($path);

                }

            }

            $video = $video->store('/uploads/' . $dir, 'public');

            $post->video = $video;

        }

        if ($photo) foreach ($photo as $item) {
            Photo::create($item);
        }

        $post->save();

        return redirect('/cabinet');

    }

    public
    function destroy($id)
    {
    }
}