<?php
namespace HopekellDev\Tatum\Helpers;

use HopekellDev\Tatum\Helpers\Utils\ExchangeRates;

class Utils
{
    protected $apiKey;
    protected $accountID;
    protected $baseUrl;

    /**
     * Construct
     */
    function __construct(String $apiKey, String $accountID, String $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->accountID = $accountID;
        $this->baseUrl = $baseUrl;
    }


    public function rate()
    {
        $rate = new ExchangeRates($this->apiKey, $this->baseUrl);
        return $rate;
    }

}