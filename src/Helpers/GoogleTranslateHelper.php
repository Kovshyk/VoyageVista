<?php

namespace App\Helpers;
use Google\Cloud\Translate\TranslateClient;

class GoogleTranslateHelper
{
    private static $translateClient = false;
    public static $apiKey  = 'AIzaSyB2VKu5-4vfa8IutFlAOumje1gsD8gT-nk';
    public static $keyFilePath = 'google_translate_conf.json';


    private static function getKeyFilePath()
    {
        return CONFIG.self::$keyFilePath;
    }

    private static function getTranslateClient()
    {
        if(!self::$translateClient) {
            self::$translateClient = new TranslateClient([
                'key' => self::$apiKey,
                'keyFilePath' => self::getKeyFilePath(),
            ]);
        }
        return self::$translateClient;
    }

    public static function translate($lang_from, $lang_to, $text)
    {
        $translateClient = self::getTranslateClient();
        $translation = $translateClient->translate($text, [
            'source' => $lang_from,
            'target' => $lang_to,
        ]);
        return $translation['text'];
    }


}