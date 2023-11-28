<?php
namespace HopekellDev\Tatum\Helpers\Utils;

use Illuminate\Support\Facades\Http;

class ExchangeRates
{
    protected $apiKey;
    protected $accountID;
    protected $baseUrl;

    /**
     * Construct
     */
    function __construct(String $apiKey, String $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get the current exchange rate for exchanging fiat/crypto assets
     */
    public function getRate($currency, $basePair = "USD")
    {
        $query = [
            "basePair" => $basePair
        ];

        $rate = Http::withToken($this->apiKey)
            ->get($this->baseUrl . '/tatum/rate/' . $currency . "?" . http_build_query($query))
            ->json();
        return $rate;
    }

}