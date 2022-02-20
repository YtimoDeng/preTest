<?php

namespace Tests\Unit;

use App\Services\ConvertCurrencyService;
use Exception;
use PHPUnit\Framework\TestCase;

class ConvertCurrencyServiceTest extends TestCase
{
    protected $convertCurrencyService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->convertCurrencyService = resolve(ConvertCurrencyService::class);
    }

    /**
     * 測試 service l
     *
     * @test
     * @dataProvider currencyTestInfo
     */
    public function testConvertCurrency(string $originCurrency, string $targetCurrency, float $amount, float $expectedAmount)
    {
        $convertedResult = $this->convertCurrencyService->convertCurrency($originCurrency, $targetCurrency, $amount);
        $this->assertEquals($expectedAmount, $convertedResult);
    }

    /**
     *  測試 Exception
     *
     * @test
     * @dataProvider currencyTestFailedInfo
    */
    public function testConvertCurrencyException(string $originCurrency, string $targetCurrency, float $amount)
    {
        $this->expectException(Exception::class);
        $this->convertCurrencyService->convertCurrency($originCurrency, $targetCurrency, $amount);
    }


    public function currencyTestInfo(): array
    {
       return [
            [
                'TWD',
                'USD',
                100,
                3.28,
            ],
            [
                'TWD',
                'JPY',
                100,
                366.90,
            ],
            [
                'USD',
                'TWD',
                100,
                3044.40,
            ],
            [
                'USD',
                'JPY',
                100,
                11180.10,
            ],
            [
                'JPY',
                'TWD',
                100,
                26.96,
            ],
            [
                'JPY',
                'USD',
                100,
                0.89,
            ],
       ];
    }

    public function currencyTestFailedInfo(): array
    {
        return [
            [
                'HKD',
                'USD',
                100,
            ],
            [
                'TWD',
                'GBP',
                100,
            ],
        ];
    }
}
