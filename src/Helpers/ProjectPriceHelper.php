<?php

namespace App\Helpers;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\CookieComponent;

class ProjectPriceHelper
{
    private static $from_ukraine = null;
    private static $ip = null;

    public static function getPrice($price)
    {

        if(self::$from_ukraine == null){
            self::$from_ukraine = self::determineFromUkraine();
        }
        if(self::$from_ukraine) {
            return $price;
        }
        $configTable = TableRegistry::get('Config');
        $coef = $configTable->findBySection('projects_coefficient')->first();
        if(empty($coef) || empty(floatval($coef->value))) {
            return $price;
        }
        return 10;
    }

    private static function getIP() {
        if(self::$ip == null){
            foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
                if (array_key_exists($key, $_SERVER) === true) {
                    foreach (explode(',', $_SERVER[$key]) as $ip) {
                        if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                            self::$ip = $ip;
                            return self::$ip;
                        }
                    }
                }
            }
        }
        return self::$ip;
    }


    private static function determineFromUkraine()
    {
        if (isset($_COOKIE['country']['ip'], $_COOKIE['country']['bool'])) {
            if($_COOKIE['country']['ip'] == self::getIP()) {
                return ($_COOKIE['country']['bool'] == 1) ? true : false;
            }
        }
        $fromUkraine = self::determineFromUkraineFromUrl();
        setcookie("country[ip]", self::getIP(), time()+(3600 * 8 * 30));
        setcookie("country[bool]", ($fromUkraine) ? 1 : 0, time()+(3600 * 8 * 30));
        return $fromUkraine;
    }
    private static function determineFromUkraineFromUrl()
    {
	    return true;

	    try {
            $result = json_decode(file_get_contents('http://getcitydetails.geobytes.com/GetCityDetails?fqcn='. self::getIP()));
            if($result->geobytescountry == '' || $result->geobytescountry == 'Ukraine') {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return true;
        }
    }

}