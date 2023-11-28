<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class VeChain
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
        $this->baseUrl = $baseUrl . '/vet/';
    }

    /**
     * Generate VeChain  wallet
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
     * Generate a VeChain address from the wallet's extended public key
     */
    public function createAddress($xpub, $index = 0)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $xpub . '/' . $index)
            ->json();
        return $address;
    }

    /**
     * Generate VeChain private key
     */
    public function generatePrivateKey(array $payload)
    {
        $privateKey = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'wallet/priv', $payload)
            ->json();

        return $privateKey;
    }

    /**
     * Get VeChain current block
     */
    public function getCurrentBlock()
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/current')
            ->json();
        return $block;
    }

    /**
     * Get VeChain Block by hash
     */
    public function getBlockByHash($hash)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $hash)
            ->json();
        return $block;
    }

    /**
     * Get VeChain Account balance
     */
    public function addressBalance(string $address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get VeChain Account energy (VTHO)
     */
    public function accountEnergy(string $address)
    {
        $energy = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/energy/' . $address)
            ->json();
        return $energy;
    }

    /**
     * Get VeChain Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get VeChain Transaction Receipt
     */
    public function transactionReceipt($hash)
    {
        $receipt = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash . "/receipt")
            ->json();
        return $receipt;
    }

    /**
     * Send VeChain from account to account
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

}