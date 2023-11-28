<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class Cardano
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
        $this->baseUrl = $baseUrl . '/ada/';
    }

    /**
     * Get Blockchain information
     */
    public function blockchainInfo()
    {
        $info = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'info')
            ->json();
        return $info;
    }

    /**
     * Generate Ada wallet
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
     * Generate Ada deposit address from Extended public key
     */
    public function createAddress($xpub, $index = 0)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $xpub . '/' . $index)
            ->json();
        return $address;
    }

    /**
     * Generate Ada private key
     */
    public function generatePrivateKey($payload)
    {
        $privateKey = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'wallet/priv', $payload)
            ->json();
        return $privateKey;
    }

    /**
     * Get Block by hash or height
     */
    public function getBlockByHash($hash)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $hash)
            ->json();
        return $block;
    }

    /**
     * Get Transaction by hash
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get transactions by address
     */
    public function getTransactions($address)
    {
        $query = array(
            "pageSize" => "50"
          );
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . "transaction/address/" . $address . "?" . http_build_query($query))
            ->json();
        return $transaction;
    }

    /**
     * Get UTXOs by address
     */
    public function getUtoxByAddress($address)
    {
        $utoxs = Http::withToken($this->apiKey)
            ->get($this->baseUrl .'/' . $address . "/utxos")
            ->json();
        return $utoxs;
    }

    /**
     * Send ADA to Cardano addresses
     */
    public function sendAda($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

}