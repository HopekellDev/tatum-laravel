<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class BinanceBeaconChain
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
        $this->baseUrl = $baseUrl . '/bnb/';
    }

    /**
     * Generate Binance wallet
     * Generates a wallet and address [returns address and private key]
     */
    public function createWallet()
    {
        $wallet = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account')
            ->json();
        return $wallet;
    }

    /**
     * Get Binance current block
     */
    public function currentBlock()
    {
        $blockNumber = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/current')
            ->json();
        return $blockNumber;
    }

    /**
     * Get Binance Transactions in Block    
     */
    public function getTransactionsInBlock($height)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $height)
            ->json();
        return $transactions;
    }

    /**
     * Get Binance Account
     */
    public function getAccount($address)
    {
        $account = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/' . $address)
            ->json();
        return $account;
    }

    /**
     * Get Binance Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get Binance Transaction by Address
     */
    public function transactionByAddress($address)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/transaction/' . $address)
            ->json();
        return $transactions;
    }

    /**
     * Send Binance / Binance Token from account to account 
     * 
     */
    public function sendBnb($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }
}