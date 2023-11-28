<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;

use Illuminate\Support\Facades\Http;

class Flow
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
        $this->baseUrl = $baseUrl . '/egld/';
    }

    /**
     * Generate Flow wallet
     */
    public function createWallet()
    {
        $payload = [];
        $wallet = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'wallet')
            ->json();

        $payload['wallet'] = $wallet;
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $wallet['mnemonic'] . "/" . 0)
            ->json();
        $payload['address'] = $address;
        return $payload;
    }

    /**
     * Generate Flow account address from Extended public key
     */
    public function createAddress($xpub, $index = 0)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $xpub . '/' . $index)
            ->json();
        return $address;
    }

    /**
     * Generate Flow public key from Extended public key
     */
    public function keyFromPublicXpub($xpub)
    {
        $publicKey = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'pubkey/' . $xpub . "/" . 0)
            ->json();
        return $publicKey;
    }

    /**
     * Generate Flow private key
     */
    public function generatePrivateKey(array $payload)
    {
        $privateKey = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'wallet/priv', $payload)
            ->json();

        return $privateKey;
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
     * Get EGLD block by hash
     */
    public function getBlockByHash($hash)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $hash)
            ->json();
        return $block;
    }

    /**
     * Get Flow events from blocks
     */
    public function eventsFromBlock(array $query)
    {
        $events = Http::withToken($this->apiKey)
            ->get($this->baseUrl . "block/events?" . http_build_query($query))
            ->json();
        return $events;
    }

    /**
     * Get Flow Transaction by hash
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get the balance of a Flow account
     */
    public function addressBalance(string $address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Send Flow to blockchain addresses
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Send arbitrary transaction to blockchain
     */
    public function sendArbitraryTransaction($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction/custom', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Create Flow address from public key
     */
    public function addressFromPubkey($payload)
    {
        $address = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'account', $payload)
            ->json();
        return $address;
    }

    /**
     * Add public key to Flow address
     */
    public function addPubkeyToAddress($payload)
    {
        $address = Http::withToken($this->apiKey)
            ->put($this->baseUrl . 'account', $payload)
            ->json();
        return $address;
    }

}