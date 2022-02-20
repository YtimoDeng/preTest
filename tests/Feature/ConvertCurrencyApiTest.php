<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConvertCurrencyApiTest extends TestCase
{
    /**
     * 測試貨幣轉換 API
     *
     * @dataProvider currencyTestInfo
     */
    public function testConvertCurrencyApi(string $originCurrency, string $targetCurrency, float $amount, string $result)
    {
        $response = $this->postJson(
            '/api/convert_currency',
            [
                'original_currency' => $originCurrency,
                'converted_currency' => $targetCurrency,
                'amount' => $amount,
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'convertedResult' => $result,
            ]);
    }

    /**
     * 測試貨幣轉換 API 失敗回傳
     *
     * @dataProvider currencyTestFailedInfo
     */
    public function testConvertCurrencyApiFailed(string $originCurrency, string $targetCurrency, float $amount)
    {
        $response = $this->postJson(
            '/api/convert_currency',
            [
                'original_currency' => $originCurrency,
                'converted_currency' => $targetCurrency,
                'amount' => $amount,
            ]
        );

        $response->assertStatus(500);

        $this->assertIsString($response['error']);
    }

    public function currencyTestInfo(): array
    {
       return [
            [
                'TWD',
                'USD',
                401243,
                '13,164.78',
            ],
            [
                'TWD',
                'JPY',
                401243,
                '1,472,160.57',
            ],
            [
                'USD',
                'TWD',
                401243,
                '12,215,441.89',
            ],
            [
                'USD',
                'JPY',
                401243,
                '44,859,368.64',
            ],
            [
                'JPY',
                'TWD',
                401243,
                '108,159.06',
            ],
            [
                'JPY',
                'USD',
                401243,
                '3,551.00',
            ],
       ];
    }

    public function currencyTestFailedInfo(): array
    {
        return [
            [
                'HKD',
                'USD',
                401243,
                '13,164.78',
            ],
            [
                'TWD',
                'HKD',
                401243,
                '1,472,160.57',
            ],
        ];
    }
}
