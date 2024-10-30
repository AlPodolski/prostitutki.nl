<?php

namespace App\Services;

use App\Models\Currency;

class PayService
{

    public $payClass;

    public function __construct($paySystem)
    {
        switch ($paySystem) {
            case Currency::OBMENKA:
                $this->payClass = new Obmenka();
                break;
            case Currency::BETAT:
                $this->payClass = new BetaPay();
                break;
        }
    }

    public function getPayUrl($orderId, $sum, $city, $currency)
    {
        return $this->payClass->getPayUrl($orderId, $sum, $city, $currency);
    }

}
