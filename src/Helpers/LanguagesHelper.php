<?php

namespace App\Helpers;


class LanguagesHelper
{
    private static $languages = [
        [
            'name' => 'Ukrainian',
            'Locale' => 'uk',
            'type' => 'main',
        ],
        [
            'name' => 'Russian',
            'Locale' => 'ru',
            'type' => 'other',
        ],
        [
            'name' => 'English',
            'Locale' => 'en',
            'type' => 'other',
        ],
        [
            'name' => 'German',
            'Locale' => 'de',
            'type' => 'other',
        ],
        [
            'name' => 'Polish',
            'Locale' => 'pl',
            'type' => 'other',
        ],
    ];

    public static function getLanguages()
    {
        return self::$languages;
    }







}