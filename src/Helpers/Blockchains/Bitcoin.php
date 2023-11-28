<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;

use Illuminate\Support\Facades\Http;

class Bitcoin
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
        $this->baseUrl = $baseUrl . '/bitcoin/';
    }


    /**
     * Generate wallet
     * Generates a wallet and address [returns xpub, mnemonic phrase and wallet address]
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
     * Generate Bitcoin deposit address from Extended public key
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
     * Get blockchain information
     */
    public function blockchainInfo()
    {
        $information = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'info')
            ->json();
        return $information;
    }

    /**
     * Get balance of an address
     */
    public function addressBalance(string $address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get balance of multiple addresses
     */
    public function multiAddressBalance(array $addresses)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/balance/batch?' . http_build_query($addresses))
            ->json();
        return $balance;
    }

    /**
     * Get Transaction of an address
     */
    public function addressTransactions(string $address, array $query)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/address/' . $address . "?" . http_build_query($query))
            ->json();
        return $transactions;
    }

    /**
     * Send Btcoin from an address
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Get bitcoin transaction by it's hash
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get information about a transaction output 
     * (UTXO) in a Bitcoin transaction
     */
    public function transactionOutputInfo($hash, $index)
    {
        $info = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'utxo/' . $hash . "/" . $index)
            ->json();
        return $info;
    }

}