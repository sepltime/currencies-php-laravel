<?php

namespace App\Http\Controllers;


use App\Currency;
use Illuminate\Http\Request;
use App\CurrencyExchange\ExchangeContract;
use App\CurrencyExchange\FreeCurrencyExchangeService;

class CurrencyController extends Controller
{

    public function __construct(ExchangeContract $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Currency::paginate(5);
    }

    public function show($code)
    {
        //
        $currency = Currency::where('code',$code)->first();

        $currency->rate = $this->service->rate($code);

        return response()->json([
            'results' => $currency
        ]);

    }

    public function handle($request, Closure $next)
    {
//        $currCode = $request->route()->getParameter('item');
//        $item   = Item::find($itemId);
//
//        if($item->isBad()) return redirect(route('dont_worry'));
//
//        return $next($request);
    }
}
