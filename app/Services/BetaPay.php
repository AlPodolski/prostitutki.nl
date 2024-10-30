<?php

namespace App\Services;

class BetaPay
{

    protected $api;

    public function __construct()
    {
        $this->api = new BetaApi(env('BETA_PUBLIC'), env(('BETA_SECRET')));
    }

    public function getPayUrl($orderId, $sum, $city, $currency)
    {
        $data = $this->api->payment($sum, $currency, $orderId, $city);

        if ($data and isset($data['body']['urlPayment'])){

            return $data['body']['urlPayment'];

        }
    }


}
