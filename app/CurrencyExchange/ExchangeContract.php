<?php

namespace App\CurrencyExchange;


interface ExchangeContract {

    public function list();

    public function rate($code);
}