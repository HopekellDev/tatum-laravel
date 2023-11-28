<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;

use Illuminate\Support\Facades\Http;

class Solana
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
        $this->baseUrl = $baseUrl . '/solana/';
    }

    /**
     * Generate Polygon  wallet
     */
    public function createWallet()
    {
        $wallet = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'wallet')
            ->json();

        return $wallet;
    }

    /**
     * Get current block number
     */
    public function getCurrentBlockNumber()
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/current')
            ->json();
        return $block;
    }

    /**
     * Get Solana block by number
     */
    public function blockByNumber($height)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $height)
            ->json();
        return $block;
    }

    /**
     * Get Solana Account balance
     */
    public function addressBalance(string $address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get Solana Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Send Solana  from account to account
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

}