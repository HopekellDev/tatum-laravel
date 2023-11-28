<?php

namespace HopekellDev\Tatum;

use HopekellDev\Tatum\Helpers\Blockchain;
use HopekellDev\Tatum\Helpers\Utils;

class Tatum
{
    protected $apiKey;
    protected $accountID;
    protected $baseUrl;

    /**
     * Construct
     */
    function __construct()
    {

        $this->apiKey = config('tatum.apiKey');
        $this->accountID = config('tatum.accountID');
        $this->baseUrl = 'https://api.tatum.io/v3';
    }

    /**
     * Generates a unique reference
     * @param $transactionPrefix
     * @return string
     */

    public function generateReference(String $transactionPrefix = NULL)
    {
        if ($transactionPrefix) {
            return $transactionPrefix . '_' . uniqid(time());
        }
        return 'ttm_' . uniqid(time());
    }

    /**
     * Access available blockchains
     * @return Blockchain
     */
    public function blockchain()
    {
        $blockchain = new Blockchain($this->apiKey, $this->accountID, $this->baseUrl);
        return $blockchain;
    }

    /**
     * Access Tatum Utils
     * @return Utils
     */
    public function utils()
    {
        $utils = new Utils($this->apiKey, $this->accountID, $this->baseUrl);
        return $utils;
    }
}
