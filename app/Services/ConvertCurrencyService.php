<?php
namespace App\Services;

use Exception;

class ConvertCurrencyService
{
    /**
     * 匯率轉換
     *
     * @param  string $originCurrency
     * @param  string $targetCurrency
     * @param  float $amount
     * @return float
     */
    public function convertCurrency(string $originCurrency, string $targetCurrency, float $amount): float
    {
        $rules = json_decode(env('CURRENCY_RULES'), true);
        $currencyRule = optional($rules['currencies'])[$originCurrency];

        if (!$currencyRule) {
            throw new Exception("Original currency not support");
        }

        $rate = optional($currencyRule)[$targetCurrency];

        if (!$rate) {
            throw new Exception("Target currency not support");
        }

        $convertedAmount = $amount * $rate;

        return round($convertedAmount, 2);
    }
}
