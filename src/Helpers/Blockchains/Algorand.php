<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;

use Illuminate\Support\Facades\Http;

class Algorand
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
        $this->baseUrl = $baseUrl . '/algorand/';
    }

    /**
     * Generate wallet
     * Generates a wallet and address [returns address,secret key, and mnemonic phrase]
     */
    public function createWallet()
    {
        $wallet = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'wallet')
            ->json();
        return $wallet;
    }

    /**
     * Generate Algorand account address from private key
     */
    public function createAddress($private)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $private)
            ->json();
        return $address;
    }

    /**
     * Get Algorand Account balance
     */
    public function getBalance($address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get current block number
     */
    public function currentBlock()
    {
        $blockNumber = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/current')
            ->json();
        return $blockNumber;
    }

    /**
     * Get Algorand block by block round number
     */
    public function blockByRoundNumber($roundNumber)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $roundNumber)
            ->json();
        return $block;
    }

    /**
     * Send Algos to an Algorand account
     */
    public function sendAlgo(array $payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Enable receiving asset on account
     */
    public function enableReciving(array $payload)
    {
        $enable = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'asset/receive', $payload)
            ->json();
        return $enable;
    }

    /**
     * Get Algorand Transaction
     */
    public function getTransaction($txid)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $txid)
            ->json();
        return $transaction;
    }

    /**
     * Broadcast signed Algorand transaction
     */
    public function broadcastSignedTransaction($payload)
    {
        $broadcast = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'broadcast', $payload)
            ->json();
        return $broadcast;
    }
}