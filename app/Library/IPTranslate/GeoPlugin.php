<?php

namespace App\Library\IPTranslate;
use Illuminate\Support\Facades\Cache;
class GeoPlugin extends \App\Library\IPTranslate\IPTranslator {

    protected function __construct() {
        
    }

    /**
     * Fetch information for this IP
     * @param string $ip IP Address
     * @return $this
     */
    public static function locate($ip = null) {
        if (is_null($ip)) {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
        }
        if (Cache::has($ip . 'naijacrawl')) {
            $res = Cache::get($ip . 'naijacrawl');
            return $res;
        } else {
            $geoIp = self::instance();
            $url = "http://www.geoplugin.net/php.gp?ip=$ip&base_currency=$geoIp->currency";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            $html = curl_exec($ch);
            curl_close($ch);
            $data = unserialize($html);

            //set the geoPlugin vars
            $geoIp->ip = $ip;
            $geoIp->city = $data['geoplugin_city'];
            $geoIp->region = $data['geoplugin_region'];
            $geoIp->areaCode = $data['geoplugin_areaCode'];
            $geoIp->dmaCode = $data['geoplugin_dmaCode'];
            $geoIp->countryCode = $data['geoplugin_countryCode'];
            $geoIp->countryName = $data['geoplugin_countryName'];
            $geoIp->continentCode = $data['geoplugin_continentCode'];
            $geoIp->latitude = $data['geoplugin_latitude'];
            $geoIp->longitude = $data['geoplugin_longitude'];
            $geoIp->currencyCode = $data['geoplugin_currencyCode'];
            $geoIp->currencySymbol = $data['geoplugin_currencySymbol'];
            $geoIp->currencyConverter = $data['geoplugin_currencyConverter'];
            Cache::put($ip . 'naijacrawl', $geoIp, 4380);
            return $geoIp;
        }
    }

    private function fetch($host) {
        if (function_exists('curl_init')) {

            //use cURL to fetch data
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $host);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
            $response = curl_exec($ch);
            curl_close($ch);
        } else if (ini_get('allow_url_fopen')) {
            //fall back to fopen()
            $response = file_get_contents($host, 'r');
        } else {
            trigger_error('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
            return;
        }

        return $response;
    }

    public function convert($amount, $float = 2, $symbol = true) {
        //easily convert amounts to geolocated currency.
        if (!is_numeric($this->currencyConverter) || $this->currencyConverter == 0) {
            trigger_error('geoPlugin class Notice: currencyConverter has no value.', E_USER_NOTICE);
            return $amount;
        }
        if (!is_numeric($amount)) {
            trigger_error('geoPlugin class Warning: The amount passed to geoPlugin::convert is not numeric.', E_USER_WARNING);
            return $amount;
        }
        if ($symbol === true) {
            return $this->currencySymbol . round(($amount * $this->currencyConverter), $float);
        } else {
            return round(($amount * $this->currencyConverter), $float);
        }
    }

    public function nearby($radius = 10, $limit = null) {
        if (!is_numeric($this->latitude) || !is_numeric($this->longitude)) {
            trigger_error('geoPlugin class Warning: Incorrect latitude or longitude values.', E_USER_NOTICE);
            return array(array());
        }

        $host = "http://www.geoplugin.net/extras/nearby.gp?lat=" . $this->latitude . "&long=" . $this->longitude . "&radius={$radius}";

        if (is_numeric($limit)) {
            $host .= "&limit={$limit}";
        }

        return unserialize($this->fetch($host));
    }

}
