<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\HairColor;
use App\Models\IntimHair;
use App\Models\Metro;
use App\Models\National;
use App\Models\Photo;
use App\Models\Place;
use App\Models\Post;
use App\Models\PostMetro;
use App\Models\PostPlace;
use App\Models\PostService;
use App\Models\PostTime;
use App\Models\Rayon;
use App\Models\Service;
use App\Models\Time;
use Illuminate\Console\Command;
use League\Csv\Reader;
use League\Csv\Statement;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $stream = \fopen(storage_path('import_08_02_2023.csv'), 'r');

        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);
        //build a statement
        $stmt = (new Statement());

        $records = $stmt->process($csv);

        $price = array(1000, 1500, 2000, 3000, 5000, 6000, 7000, 10000);

        $serviceList = Service::all();
        $placeList = Place::all();
        $timeList = Time::all();

        $posts = array();

        foreach ($records as $record) {

            if ($record['name']) {

                $posts[] = $record;

            }
        }


        $cityId = 1;

        $path = 'aaa/';

        $cityList = City::where('url', '<>', 'moskva')->get();

        foreach ($cityList as $cityItem){
            $i = 0;
            $cityId = $cityItem->id;

            shuffle($posts);

            foreach ($posts as $record){

                $post = new Post();

                $price = 3000;
                if ($record['hour']) $price = $record['hour'];

                $post->name = $record['name'];
                $post->age = $record['age'];
                $post->site_id = 2;
                $post->phone = '1';
                $post->rost = $record['rost'];
                $post->ves = $record['weight'];
                $post->breast = $record['grud'];
                $post->tatu = $record['tatu'];
                $post->pircing = $record['pirsing'];
                $post->about = strip_tags($record['anket-about']);
                $post->city_id = $cityId;
                $post->check_photo_status = rand(0,1);
                $post->price = $price;
                if ($record['2hour']) $post->apartament_2_hour_price = $record['2hour'] ?? 0;
                if ($record['night']) $post->apartament_night_price = $record['night'] ?? 0;
                if ($record['hour_viezd']) $post->exit_1_hour_price = $record['hour_viezd'] ?? 0;
                if ($record['2hour_viezd'])$post->exit_2_hour_price = $record['2hour_viezd'] ?? 0;
                if ($record['night_viezd']) $post->exit_night_price = $record['night_viezd'] ?? 0;
                $post->publication_status = 1;
                $post->user_id = 0;
                $post->url = '';
                $post->shoe_size = rand(36,40);
                $post->clothing_size = 0;

                $post->contacts_per_hour = rand(1, 3);

                $post->avatar = $path.$record['mini'];
                if ($record['video']) $post->video = $path.$record['video'];

                if ($post->save()) {

                    $post->url = \Str::slug($post->name).'-'.$post->id;

                    if ($record['metro'] and false) {

                        $dataList = explode(',', $record['metro']);

                        foreach ($dataList as $item) {

                            if ($temp = Metro::where(['value' => $item, 'city_id' => $cityId])->get()->first()) {

                                $postRelation = new PostMetro();
                                $postRelation->city_id = $cityId;
                                $postRelation->posts_id = $post->id;
                                $postRelation->metros_id = $temp->id;

                                $postRelation->save();

                            }

                        }

                    }

                    if ($record['gallery']) {

                        $dataList = explode(',', $record['gallery']);

                        foreach ($dataList as $item) {

                            $file = new Photo();

                            $file->posts_id = $post->id;
                            $file->file = $path. $item;
                            $file->type = Photo::GALLERY_TYPE;

                            $file->save();

                        }

                    }

                    if (isset($record['intim']) and $record['intim']) {

                        if ($temp = IntimHair::where(['value' => $record['intim']])->get()->first()) {

                            $post->intim_hair_id = $temp->id;

                        }

                    }

                    if ($record['hair']) {

                        if ($temp = HairColor::where(['value' => $record['hair']])->get()->first()) {

                            $post->hair_color_id = $temp->id;

                        }

                    }

                    if (isset($record['rayon']) and $record['rayon'] and false) {

                        if ($temp = Rayon::where(['value' => $record['rayon']])->get()->first()) {

                            $post->rayon_id = $temp->id;

                        }

                    }

                    if (isset($record['eth']) and $record['eth']) {

                        if ($temp = National::where(['value' => $record['eth']])->get()->first()) {

                            $post->national_id = $temp->id;

                        }

                    }

                    foreach ($serviceList as $service) {

                        if (rand(0, 1)) {

                            $postService = new PostService();

                            $postService->posts_id = $post->id;
                            $postService->service_id = $service->id;
                            $postService->city_id = $cityId;

                            $postService->save();

                        }

                    }

                    foreach ($placeList as $item) {

                        if (rand(0, 1)) {

                            $postRelation = new PostPlace();
                            $postRelation->city_id = $cityId;
                            $postRelation->posts_id = $post->id;
                            $postRelation->place_id = $item->id;

                            $postRelation->save();

                        }

                    }

                    foreach ($timeList as $item) {

                        if (rand(0, 1)) {

                            $postRelation = new PostTime();
                            $postRelation->city_id = $cityId;
                            $postRelation->posts_id = $post->id;
                            $postRelation->times_id = $item->id;

                            $postRelation->save();

                        }

                    }

                    $post->save();

                    $i++;

                    if ($i > 600) break;

                }

            }

        }

    }

}
