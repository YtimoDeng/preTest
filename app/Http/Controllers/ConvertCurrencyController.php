<?php

namespace App\Http\Controllers;

use App\Formatters\CurrencyFormatter;
use App\Http\Requests\ConvertCurrencyRequest;
use App\Services\ConvertCurrencyService;
use Illuminate\Http\Request;

class ConvertCurrencyController extends Controller
{
    private $convertCurrencyService;

    public function __construct(ConvertCurrencyService $convertCurrencyService)
    {
        $this->convertCurrencyService = $convertCurrencyService;
    }

    /**
     *   匯率轉換.
     *
     * @param  \Illuminate\Http\ConvertCurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ConvertCurrencyRequest $request)
    {
        $convertedResult = $this->convertCurrencyService->convertCurrency(
            $request->input('original_currency'),
            $request->input('converted_currency'),
            $request->input('amount'),
        );

        return response(CurrencyFormatter::currencyFormat($convertedResult, 2));
    }
}
