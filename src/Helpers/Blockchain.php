<?php
namespace HopekellDev\Tatum\Helpers;

use HopekellDev\Tatum\Helpers\Blockchains\Algorand;
use HopekellDev\Tatum\Helpers\Blockchains\BinanceBeaconChain;
use HopekellDev\Tatum\Helpers\Blockchains\BinanceSmartChain;
use HopekellDev\Tatum\Helpers\Blockchains\Bitcoin;
use HopekellDev\Tatum\Helpers\Blockchains\BitcoinCash;
use HopekellDev\Tatum\Helpers\Blockchains\Cardano;
use HopekellDev\Tatum\Helpers\Blockchains\Celo;
use HopekellDev\Tatum\Helpers\Blockchains\Dogecoin;
use HopekellDev\Tatum\Helpers\Blockchains\Elrond;
use HopekellDev\Tatum\Helpers\Blockchains\Ethereum;
use HopekellDev\Tatum\Helpers\Blockchains\Harmony;
use HopekellDev\Tatum\Helpers\Blockchains\Klaytn;
use HopekellDev\Tatum\Helpers\Blockchains\KuCoin;
use HopekellDev\Tatum\Helpers\Blockchains\Litecoin;
use HopekellDev\Tatum\Helpers\Blockchains\Polygon;
use HopekellDev\Tatum\Helpers\Blockchains\Solana;
use HopekellDev\Tatum\Helpers\Blockchains\Stellar;
use HopekellDev\Tatum\Helpers\Blockchains\Tron;
use HopekellDev\Tatum\Helpers\Blockchains\VeChain;
use HopekellDev\Tatum\Helpers\Blockchains\XinFin;
use HopekellDev\Tatum\Helpers\Blockchains\XRP;

class Blockchain
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
        $this->baseUrl = $baseUrl;
    }

    /**
     * Handle Bitcoin Blockchan
     *
     * @return Bitcoin
     */
    public function bitcoin()
    {
        $bitcoin = new Bitcoin($this->apiKey, $this->accountID, $this->baseUrl);
        return $bitcoin;
    }

    /**
     * Handle Algorand Blockchan
     *
     * @return Algorand
     */
    public function algorand()
    {
        $algorand = new Algorand($this->apiKey, $this->accountID, $this->baseUrl);
        return $algorand;
    }

    /**
     * Handle BitcoinCash Blockchan
     *
     * @return BitcoinCash
     */
    public function bitcoincash()
    {
        $bitcoincash = new BitcoinCash($this->apiKey, $this->accountID, $this->baseUrl);
        return $bitcoincash;
    }
    
    /**
     * Binance Smart Chain
     *
     * @return BinanceSmartChain
     */
    public function bsc()
    {
        $bsc = new BinanceSmartChain($this->apiKey, $this->accountID, $this->baseUrl);
        return $bsc;
    }
    
    /**
     * Binance Beacon Chain
     *
     * @return BinanceBeaconChain
     */
    public function bnb()
    {
        $bsc = new BinanceBeaconChain($this->apiKey, $this->accountID, $this->baseUrl);
        return $bsc;
    }

    /**
     * Handle Cardona Blockchain
     *
     * @return Celo
     */
    public function cardano()
    {
        $celo = new Cardano($this->apiKey, $this->accountID, $this->baseUrl);
        return $celo;
    }

    /**
     * Handle Celo Blockchain
     *
     * @return Celo
     */
    public function celo()
    {
        $celo = new Celo($this->apiKey, $this->accountID, $this->baseUrl);
        return $celo;
    }

    /**
     *  Handle Dogecoin Blockchain
     *
     * @return Dogecoin
     */
    public function dogecoin()
    {
        $dogecoin = new Dogecoin($this->apiKey, $this->accountID, $this->baseUrl);
        return $dogecoin;
    }

    /**
     * Handle Elrond blockchain
     *
     * @return Elrond
     */
    public function elrond()
    {
        $elrond = new Elrond($this->apiKey, $this->accountID, $this->baseUrl);
        return $elrond;
    }

    /**
     * Ethereum network
     *
     * @return Ethereum
     */
    public function ethereum()
    {
        $ethereum = new Ethereum($this->apiKey, $this->accountID, $this->baseUrl);
        return $ethereum;
    }

    /**
     * Undocumented function
     *
     * @return Harmony
     */
    public function harmony()
    {
        $harmony = new Harmony($this->apiKey, $this->accountID, $this->baseUrl);
        return $harmony;
    }

    /**
     * Undocumented function
     *
     * @return Klaytn
     */
    public function klaytn()
    {
        $klaytn = new Klaytn($this->apiKey, $this->accountID, $this->baseUrl);
        return $klaytn;
    }

    /**
     * Undocumented function
     *
     * @return KuCoin
     */
    public function kucoin()
    {
        $kucoin = new KuCoin($this->apiKey, $this->accountID, $this->baseUrl);
        return $kucoin;
    }

    /**
     * Undocumented function
     *
     * @return Litecoin
     */
    public function litecoin()
    {
        $litecoin = new Litecoin($this->apiKey, $this->accountID, $this->baseUrl);
        return $litecoin;
    }

    /**
     * Undocumented function
     *
     * @return Polygon
     */
    public function polygon()
    {
        $polygon = new Polygon($this->apiKey, $this->accountID, $this->baseUrl);
        return $polygon;
    }

    /**
     * Undocumented function
     *
     * @return Solana
     */
    public function solana()
    {
        $polygon = new Solana($this->apiKey, $this->accountID, $this->baseUrl);
        return $polygon;
    }

    /**
     * Undocumented function
     *
     * @return Stellar
     */
    public function stellar()
    {
        $stellar = new Stellar($this->apiKey, $this->accountID, $this->baseUrl);
        return $stellar;
    }

    /**
     * Undocumented function
     *
     * @return Tron
     */
    public function tron()
    {
        $tron = new Tron($this->apiKey, $this->accountID, $this->baseUrl);
        return $tron;
    }

    /**
     * Undocumented function
     *
     * @return VeChain
     */
    public function vechain()
    {
        $vechain = new VeChain($this->apiKey, $this->accountID, $this->baseUrl);
        return $vechain;
    }

    /**
     * Undocumented function
     *
     * @return XinFin
     */
    public function xinfin()
    {
        $xinfin = new XinFin($this->apiKey, $this->accountID, $this->baseUrl);
        return $xinfin;
    }

    /**
     * Undocumented function
     *
     * @return XRP
     */
    public function xrp()
    {
        $xrp = new XRP($this->apiKey, $this->accountID, $this->baseUrl);
        return $xrp;
    }
}