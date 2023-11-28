<?php

namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class Stellar
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
        $this->baseUrl = $baseUrl . '/xlm/';
    }

    /**
     * Generate XLM account
     */
    public function createWallet()
    {
        $payload = [];
        $wallet = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account')
            ->json();
        return $wallet;
    }

    /**
     * Get XLM Blockchain Ledger by sequence
     */
    public function blockchainLedger($sequence)
    {
        $ledger = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'ledger/' . $sequence)
            ->json();
        return $ledger;
    }

    /**
     * Get XLM Blockchain Transactions in Ledger
     */
    public function blockchainTransationInLedger($sequence)
    {
        $ledger = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'ledger/' . $sequence . '/transaction')
            ->json();
        return $ledger;
    }

    /**
     * Get actual XLM fee
     */
    public function xlmFee()
    {
        $fee = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'fee')
            ->json();
        return $fee;
    }

    /**
     * Get XLM Account transactions
     */
    public function accountTransactions($account)
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . "account/tx/" . $account)
            ->json();
        return $transactions;
    }

    /**
     * Get XLM Transaction
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get XLM Account info
     */
    public function accountInfo($account)
    {
        $info = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'account/' . $account)
            ->json();
        return $info;
    }

    /**
     * Send XLM  from account to account
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

    /**
     * Create / Update / Delete XLM trust line
     */
    public function trustLine($payload)
    {
        $trustline = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'trust', $payload)
            ->json();
        return $trustline;
    }

}