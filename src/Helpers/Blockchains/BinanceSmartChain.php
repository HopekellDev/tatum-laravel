<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;

use Illuminate\Support\Facades\Http;

class BinanceSmartChain
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
        $this->baseUrl = $baseUrl . '/bsc/';
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
     * Generate BSC account address from Extended public key
     */
    public function createAddress($xpub, $index = 0)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $xpub . '/' . $index)
            ->json();
        return $address;
    }

    /**
     * Generate BSC private key
     */
    public function generatePrivateKey($payload)
    {
        $privateKey = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'wallet/priv', $payload)
            ->json();
        return $privateKey;
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
     * Get BSC block by hash
     */
    public function blockByHash($hash)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $hash)
            ->json();
        return $block;
    }

    /**
     * Get BSC Account balance
     */
    public function getBalance($address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get BSC Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get count of outgoing BSC transactions
     */
    public function outgoingTransactionCount($address)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/count/' . $address)
            ->json();
        return $transactions;
    }

    /**
     * Send BSC / BEP20 from account to account
     */
    public function sendBep20($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Broadcast signed BSC transaction
     */
    public function broadcastSignedTransaction($payload)
    {
        $broadcast = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'broadcast', $payload)
            ->json();
        return $broadcast;
    }

}