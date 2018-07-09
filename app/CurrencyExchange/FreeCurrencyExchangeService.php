<?php

namespace App\CurrencyExchange;

use Cache;

class FreeCurrencyExchangeService implements  ExchangeContract
{
    const exchangeApi = 'https://free.currencyconverterapi.com/api/v5/';
    // need to implement list and rate
    public function list()
    {

        return $this->call(self::exchangeApi . '/currencies');

    }

    public function rate($code){
        if (Cache::has('rate_'.$code)) {
            // from cache
            $output = Cache::get('rate_'.$code);
            return json_decode($output, true);
        }

        $output = $this->call(self::exchangeApi . 'convert?q=USD_' .$code.'&compact=y');

        return tap($output, function($rate) use ($code) {
            $expiresAt = now()->addMinutes(10);

            Cache::put('rate_'.$code, json_encode($rate), $expiresAt);
        });

    }

    protected function call($api) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$api);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);
        return  json_decode($output, true);
    }

}