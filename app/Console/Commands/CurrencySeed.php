<?php

namespace App\Console\Commands;

use App\Currency;
use Illuminate\Console\Command;
use App\CurrencyExchange\ExchangeContract;
use App\CurrencyExchange\FreeCurrencyExchangeService;

class CurrencySeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    const exchangeApi = 'https://free.currencyconverterapi.com/api/v5/';
    protected $signature = 'currency:seed';

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
    public function __construct(ExchangeContract $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        //dd(self::exchangeApi . '/convert?q=USD_' .'ILS'.'&compact=y');
        $output = $this->service->list();

        foreach ($output['results'] as $code=>$entry){
           // dd($code, isset($entry['currencySymbol']) == true ? $entry['currencySymbol'] : "");
           $currency = Currency::create([ 'code' => $entry['id'],'name' => $entry['currencyName'], 'symbol' => (isset($entry['currencySymbol']) == true ? $entry['currencySymbol'] : "")   ]);

        }
    }
}
