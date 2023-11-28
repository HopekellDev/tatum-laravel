<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class XRP
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
        $this->baseUrl = $baseUrl . '/xrp/';
    }

    /**
     * Generate XinFin wallet
     */
    public function createWallet()
    {
        $wallet = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account')
            ->json();
        return $wallet;
    }

    /**
     * Get XRP Blockchain Information
     */
    public function blockchainInfo()
    {
        $info = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'info')
            ->json();
        return $info;
    }

    /**
     * Get actual Blockchain fee
     */
    public function blockchainFee()
    {
        $fee = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'fee')
            ->json();
        return $fee;
    }

    /**
     * Get Account transactions
     */
    public function accountTransactions($account)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/tx/' . $account)
            ->json();
        return $transactions;
    }

    /**
     * Get Ledger
     */
    public function getLedger($i=0)
    {
        $ledger = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'ledger/' . $i)
            ->json();
        return $ledger;
    }

    /**
     * Get XRP Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get Account info
     */
    public function accountInfo($address)
    {
        $info = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/' . $address)
            ->json();
        return $info;
    }

    /**
     * Get XRP Account balance
     */
    public function addressBalance(string $address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . "account/" . $address . "/balance")
            ->json();
        return $balance;
    }

    /**
     * Send XRP from account to account
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Create / Update / Delete XRP trust line
     */
    public function trustLine($payload)
    {
        $trustline = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'trust', $payload)
            ->json();
        return $trustline;
    }

}