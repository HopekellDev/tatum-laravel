<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class Tron
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
        $this->baseUrl = $baseUrl . '/tron/';
    }

    /**
     * Generate Tron  wallet
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
     * Generate a TRON address from the wallet's extended public key
     */
    public function createAddress($xpub, $index = 0)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $xpub . '/' . $index)
            ->json();
        return $address;
    }

    /**
     * Generate the private key for a TRON address
     */
    public function generatePrivateKey(array $payload)
    {
        $privateKey = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'wallet/priv', $payload)
            ->json();

        return $privateKey;
    }

    /**
     * Get the current TRON block
     */
    public function getCurrentBlock()
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'info')
            ->json();
        return $block;
    }

    /**
     * Get a TRON block by its hash or height
     */
    public function getBlockByHash($hash)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $hash)
            ->json();
        return $block;
    }

    /**
     * Get the TRON account by its address
     */
    public function getAccount($address)
    {
        $account = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/' . $address)
            ->json();
        return $account;
    }

    /**
     * Freeze the balance of a TRON account
     */
    public function freezeBalance(array $payload)
    {
        $account = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'freezeBalance', $payload)
            ->json();
        return $account;
    }

    /**
     * Unfreeze the balance of a TRON account
     */
    public function unfreezeBalance(array $payload)
    {
        $account = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'unfreezeBalance', $payload)
            ->json();
        return $account;
    }

    /**
     * Get all transactions for a TRON account
     */
    public function allTransactions($address)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/' . $address)
            ->json();
        return $transactions;
    }

    /**
     * Get TRC-20 transactions for a TRON account
     */
    public function trc20Transactions($address)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/' . $address . "/trc20")
            ->json();
        return $transactions;
    }

    /**
     * Send TRX to a TRON account
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Send TRC-10 tokens to a TRON account
     */
    public function sendTrc10($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'trc10/transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Send TRC-20 tokens to a TRON account
     */
    public function sendTrc20($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'trc20/transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Create a TRC-10 token
     */
    public function deployTrc10($payload)
    {
        $token = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'trc10/deploy', $payload)
            ->json();
        return $token;
    }

    /**
     * Get information about a TRC-20 token
     */
    public function trc10Info($idOrOwnerAddress)
    {
        $tokenInfo = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'trc10/detail', $idOrOwnerAddress)
            ->json();
        return $tokenInfo;
    }


     /**
      * Deploy Trc 20 Token
      *
      * @param array $payload
      * @return void
      */
    public function deployTrc20($payload)
    {
        $token = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'trc20/deploy', $payload)
            ->json();
        return $token;
    }

    /**
     * Get a TRON transaction by its hash
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

}