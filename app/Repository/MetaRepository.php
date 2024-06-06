<?php

namespace App\Repository;

use App\Models\Filter;
use App\Models\Meta;
use Cache;
use Carbon\Carbon;

class MetaRepository
{

    public function getForMain( $cityInfo, $request)
    {

        $value = \Cache::get('meta_'.$request->requestUri.'_'.$cityInfo['id'].'_site_id_'.SITE);

        if (!$value){

            $meta = Meta::where(['url' => '/'])
                ->where('site_id', SITE_ID)
                ->select('title', 'des', 'h1')
                ->get()
                ->first();

            if ($meta) {

                $value = $this->replaceCity($meta->toArray(), $cityInfo);

                $value = $this->addPageNum($value);

            }

            \Cache::set('meta_/_'.$cityInfo['id'].'_site_id_'.SITE, $value);

        }

        return $value;

    }

    private function addPageNum($meta){

        if (isset($_GET['page'])) {

            foreach ($meta as $key => &$value) {

                if ($key == 'title' or $key == 'des')$value = $value . ' страница № ' .$_GET['page'];

            }

        }

        return $meta;

    }

    public function getForFilter($url, $cityInfo, $filterParams)
    {

        $value = \Cache::get('meta_'.$url.'_'.$cityInfo['id'].'_site_id_'.SITE);

        if (!$value){

            if ($meta = Meta::where(['url' => $url])
                ->where('site_id', SITE_ID)
                ->select('title', 'des', 'h1')
                ->get()->first()) {

                $meta = $meta->toArray();

                $value = $this->replaceCity($meta, $cityInfo);

            } elseif (count($filterParams) == 1 and $meta = Meta::where(['url' => $filterParams[0]->short_name])
                    ->where('site_id', SITE_ID)
                    ->select('title', 'des', 'h1')->get()->first()) {

                $meta = $meta->toArray();

                $result = $this->replaceParams($meta, $filterParams);

                $value = $this->replaceCity($result, $cityInfo);

            } else {

                $meta = Meta::where(['url' => 'default'])
                    ->where('site_id', SITE_ID)
                    ->select('title', 'des', 'h1')->get()->first();

                $meta = $meta->toArray();

                $result = $this->replaceParams($meta, $filterParams);

                $value = $this->clean($this->replaceCity($result, $cityInfo));

            }

            \Cache::set('meta_'.$url.'_'.$cityInfo['id'].'_site_id_'.SITE, $value);

        }

        return $value;

    }

    public function getForFavorite(): array
    {
        return [
            'title' => 'Избранные анкеты – intim-box.com',
            'des' => 'Ваши избранные анкеты на сайте',
            'h1' => 'Избранные анкеты',
        ];
    }

    public function getForSearch(): array
    {
        $data = [
            'title' => 'Поиск',
            'des' => 'Поиск',
            'h1' => 'Поиск',
        ];

        return $data;
    }

    private function replaceParams($meta, $filterParamsList)
    {

        foreach ($meta as &$metaItem) {

            $pattern = '#:[a-z-A-Z-0-9]+#';

            if (preg_match_all($pattern, $metaItem, $marches)) {

                foreach ($marches[0] as $param) {

                    $findValue = str_replace(':', '', $param);

                    foreach ($filterParamsList as $filterParams){

                        if (strstr($findValue, $filterParams->short_name)) {

                            $expire = Carbon::now()->addMinutes(1000);

                            $replaceData = Cache::remember($filterParams->parent_class.'_'.$filterParams->related_id, $expire, function() use ($filterParams) {

                                return $filterParams->parent_class::where(['id' => $filterParams->related_id])
                                    ->get()->first()->toArray();

                            });


                            $replace = 'value' . str_replace($filterParams->short_name, '', $findValue);

                            $metaItem = $this->replaceOne($param, $replaceData[$replace], $metaItem);

                            $pattern = "#\[[^:.]+\]#i";

                            if (preg_match($pattern, $metaItem, $m)) {

                                $m[0] = str_replace('[', '', $m[0]);
                                $m[0] = str_replace(']', '', $m[0]);

                                $metaItem = preg_replace($pattern, $m[0] . ' [' . $param . '] ', $metaItem);

                            }

                        }

                    }

                }

            }

        }

        return $meta;

    }

    private function addPageAndSite($meta, $request){

        $pageText = '';

        if($page = $request->get('page')) $pageText = ' Страница '.$page;

        foreach ($meta as $key => &$item){

            if ($key != 'h1')$item = $item . ' на сайте '. $_SERVER['SERVER_NAME'] . $pageText;

        }

        return $meta;

    }

    private function clean($meta)
    {

        foreach ($meta as &$metaItem){

            $metaItem = preg_replace('#\[.*?\]#', '', $metaItem);

        }

        return $meta;

    }

    private function replaceOne($search, $replace, $text)
    {

        $pos = strpos($text, $search);
        return $pos !== false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;

    }

    private function replaceCity($meta, $cityInfo)
    {

        $result = array();

        foreach ($meta as $key => $metaItem) {

            $pattern = '#:[city0-9]+#';

            if (preg_match_all($pattern, $metaItem, $marches)) {

                foreach ($marches[0] as $param) {

                    if (strstr($param, 'city')){

                        $findValue = str_replace(':', '', $param);

                        $result[$key] = str_replace($param, $cityInfo[$findValue], $metaItem);

                    }else {

                        $result[$key] = $metaItem;

                    }

                }

            } else {

                $result[$key] = $metaItem;

            }

        }

        return $result;

    }

}
