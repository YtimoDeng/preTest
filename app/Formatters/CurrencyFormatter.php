<?php
namespace App\Formatters;

/**
 *  金額顯示格式‘
 */
class CurrencyFormatter
{
    public static function currencyFormat(float $amount, int $decimals): string
    {
        return number_format($amount, $decimals);
    }
}
