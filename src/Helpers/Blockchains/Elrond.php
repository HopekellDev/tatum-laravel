<?php
namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class Elrond
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
     * Generate ELGD wallet
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
     * Generate EGLD account address from mnemonic
     */
    public function createAddress($mnemonic)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $mnemonic . "/" . 0)
            ->json();
        return $address;
    }

    /**
     * Generate EGLD private key    
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
     * Get EGLD Account balance
     */
    public function getAccountBalance($address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get EGLD Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get count of outgoing EGLD transactions
     */
    public function getTransactionCount($address)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/count/' . $address)
            ->json();
        return $transactions;
    }

    /**
     * Send EGLD from account to account
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }


}