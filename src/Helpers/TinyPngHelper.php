<?php

namespace App\Helpers;

use Tinify\Tinify;

class TinyPngHelper
{
    public static $apiKey = 'V10v9XGttwlh08Z2J3LMHx32bySxkz25';
    public static $setted = 0;

    private static function setKey()
    {

        if (!self::$setted) {
            try {
                \Tinify\setKey(self::$apiKey);
                \Tinify\validate();
            } catch (\Tinify\Exception $e) {
                return false;
            }
            self::$setted = 1;
        }
        return true;
    }


    public static function tinify($file)
    {
        if (!file_exists($file)) {
            return false;
        }
        if (!self::setKey()) {
            return false;
        };
        try {
            $source = \Tinify\fromFile($file);
            $source->toFile($file);
        } catch (\Tinify\Exception $e) {
            return false;
        }
        return true;
    }

    public static function fitToWidth($width, $file_from, $file_to)
    {
        if (!file_exists($file_from)) {
            return false;
        }
        if (!self::setKey()) {
            return false;
        };
        try {
            $source = \Tinify\fromFile($file_from);
            $source = $source->resize(array(
                "method" => "scale",
                "width" => $width,
            ));
            $source->toFile($file_to);
        } catch (\Tinify\Exception $e) {
            return false;
        }
        return true;
    }


    public static function fitToHeight($height, $file_from, $file_to)
    {
        if (!file_exists($file_from)) {
            return false;
        }
        if (!self::setKey()) {
            return false;
        };
        try {
            $source = \Tinify\fromFile($file_from);
            $source = $source->resize(array(
                "method" => "scale",
                "height" => $height,
            ));
            $source->toFile($file_to);
        } catch (\Tinify\Exception $e) {
            return false;
        }
        return true;
    }


}