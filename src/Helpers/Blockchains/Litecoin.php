<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;

use Illuminate\Support\Facades\Http;

class Litecoin
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
        $this->baseUrl = $baseUrl . '/litecoin/';
    }

    /**
     * Generate Litecoin wallet
     */
    public function createWallet()
    {
        $payload = [];
        $wallet = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'wallet')
            ->json();

        $payload['wallet'] = $wallet;
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $wallet['xpub'] . "/" . 0)
            ->json();
        $payload['address'] = $address;
        return $payload;
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
     * Get Litecoin block by hash
     */
    public function getBlockByHash($hash)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $hash)
            ->json();
        return $block;
    }

    /**
     * Get Litecoin Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get Mempool Transactions
     *
     * @return Transactions
     */
    public function transactionsMemPool()
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'mempool')
            ->json();
        return $transactions;
    }

    /**
     * Get Litecoin Transactions by address
     *
     * @return Transactions
     */
    public function transactionsByAddress($address)
    {
        $query  = [
            "pageSize" => "10"
        ];
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . "transaction/address/" . $address . "?" . http_build_query($query))
            ->json();
        return $transactions;
    }

    /**
     * Get Litecoin Account balance
     */
    public function addressBalance(string $address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get the balance of multiple Litecoin addresses
     */
    public function multiAddressBalance(string $address)
    {
        $query = [
            "addresses" => $address
        ];
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . "address/balance/batch?" . http_build_query($query))
            ->json();
        return $balance;
    }

    /**
     * Generate Litecoin account address from Extended public key
     */
    public function createAddress($xpub, $index = 0)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $xpub . '/' . $index)
            ->json();
        return $address;
    }

    /**
     * Generate wallet private key
     */
    public function generatePrivateKey(array $payload)
    {
        $privateKey = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'wallet/priv', $payload)
            ->json();

        return $privateKey;
    }

    /**
     * Send Litecoin from account to account
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

}