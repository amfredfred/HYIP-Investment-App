<?php

namespace App\Library\IPTranslate;

use Exception;
use SimpleXMLElement;

class IP2LocationApi extends \App\Library\IPTranslate\IPTranslator
{

    protected $service = 'api.ipinfodb.com';
    protected $version = 'v3';
    protected $apiKey = '';

    protected function __construct()
    {
        $this->apiKey = setting('IP2LOC_KEY');
        $this->ip = $_SERVER['REMOTE_ADDR'] ?? '';
    }

    public function setKey($key)
    {
        if (!empty($key))
            $this->apiKey = $key;
    }

    /**
     * 
     * @param type $host
     * @param type $lite
     * @return IP2LocationApi
     */
    public static function locate($host = '', $lite = false)
    {
        return self::getResult($host, $lite ? 'ip-country' : 'ip-city');
    }

    private static function getResult($host, $name)
    {
        $api = self::instance();

        if (!empty($host)) {
            $api->ip = $host;
        }

        $ip = @gethostbyname($api->ip);
        // if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $xml = @file_get_contents('http://' . $api->service
                            . '/' . $api->version
                            . '/' . $name
                            . '/?key=' . $api->apiKey
                            . '&ip=' . $ip . '&format=xml');

            if (get_magic_quotes_runtime()) {
                $xml = stripslashes($xml);
            }

            $response = @new SimpleXMLElement($xml);

            $api->city = strval($response->cityName);
            $api->region = strval($response->regionName);
            $api->areaCode = strval($response->zipCode);
            $api->countryCode = strval($response->countryCode);
            $api->countryName = strval($response->countryName);
            $api->latitude = strval($response->latitude);
            $api->longitude = strval($response->longitude);
            $api->longitude = strval($response->longitude);
            $api->timeZone = strval($response->timeZone);
        } else {
            throw new Exception("$host is not a valid IP address or hostname.");
        }

        return $api;
    }

}
