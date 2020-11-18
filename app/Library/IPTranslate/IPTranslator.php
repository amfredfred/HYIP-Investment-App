<?php

namespace App\Library\IPTranslate;

/**
 * Description of IPTranslator
 *
 * @author Victor Anuebunwa
 */
abstract class IPTranslator
{

    //the default base currency
    protected $currency = 'USD';
    //initiate location vars
    protected $ip = null;
    protected $city = null;
    protected $region = null;
    protected $areaCode = null;
    protected $dmaCode = null;
    protected $countryCode = null;
    protected $countryName = null;
    protected $continentCode = null;
    protected $latitude = null;
    protected $longitude = null;
    protected $currencyCode = null;
    protected $currencySymbol = null;
    protected $currencyConverter = null;
    protected $timeZone = null;
    //Instance
    protected static $instance = null;

    protected static function instance()
    {
        if (!is_object(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public static abstract function locate($ip = null);

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getState()
    {
        return $this->region;
    }

    public function getAreaCode()
    {
        return $this->areaCode;
    }

    public function getZipCode()
    {
        return $this->areaCode;
    }

    public function getDmaCode()
    {
        return $this->dmaCode;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCountryName()
    {
        return $this->countryName;
    }

    public function getContinentCode()
    {
        return $this->continentCode;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    public function getCurrencyConverter()
    {
        return $this->currencyConverter;
    }

    public function getTimeZone()
    {
        return $this->timeZone;
    }

}
