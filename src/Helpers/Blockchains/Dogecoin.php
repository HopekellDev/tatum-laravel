<?php
namespace HopekellDev\Tatum\Helpers\Blockchains;
use Illuminate\Support\Facades\Http;

class Dogecoin
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
        $this->baseUrl = $baseUrl . '/dogecoin/';
    }

    /**
     * Generate Celo wallet
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
     * Generate Dogecoin deposit address from Extended public key
     */
    public function createAddress($xpub, $index = 0)
    {
        $address = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/' . $xpub . '/' . $index)
            ->json();
        return $address;
    }

    /**
     * Generate Dogecoin private key
     */
    public function generatePrivateKey($payload)
    {
        $privateKey = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'wallet/priv', $payload)
            ->json();
        return $privateKey;
    }

    /**
     * Get Dogecoin Blockchain Information
     */
    public function blockchainInfo()
    {
        $info = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'info')
            ->json();
        return $info;
    }

    /**
     * Get Dogecoin Block hash
     */
    public function getBlockHash($i)
    {
        $blockHash = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/hash/' . $i)
            ->json();
        return $blockHash;
    }

    /**
     * Get Dogecoin block by hash
     */
    public function getBlockByHash($hash)
    {
        $block = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'block/' . $hash)
            ->json();
        return $block;
    }

    /**
     * Get Dogecoin  Transaction by Hash
     */
    public function getTransaction($hash)
    {
        $transaction = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/' . $hash)
            ->json();
        return $transaction;
    }

    /**
     * Get Dogecoin Transactions by address
     */
    public function getTransactions($address)
    {
        $query = [
            "pageSize" => "50"
        ];
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'transaction/address/' . $address . "?" . http_build_query($query))
            ->json();
        return $transactions;
    }

    /**
     * Get the balance of a Dogecoin address
     */
    public function getBalance($address)
    {
        $balance = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/balance/' . $address)
            ->json();
        return $balance;
    }

    /**
     * Get the balance of multiple Dogecoin addresses
     */
    public function transactionsMultiAddress($addresses)
    {
        $query = [
            "addresses" => $addresses
        ];
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'address/balance/batch?' . http_build_query($query))
            ->json();
        return $transactions;
    }

    /**
     * Get Mempool Transactions
     *
     * @return Transactions
     */
    public function transactionsMemPool()
    {
        $transactions = Http::withToken($this->apiKey)
            ->get($this->baseUrl . 'mempool')
            ->json();
        return $transactions;
    }

    /**
     * end DOGE to Dogecoin addresses
     */
    public function sendCoin($payload)
    {
        $transaction = Http::withToken($this->apiKey)
            ->post($this->baseUrl . 'transaction', $payload)
            ->json();
        return $transaction;
    }

}