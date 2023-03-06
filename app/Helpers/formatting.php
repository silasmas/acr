<?php

use Illuminate\Support\Facades\Session;

if (!function_exists("getRandomNumber")) {
    function getRandomNumber($n)
    {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}

if (!function_exists("formatIntegerNumber")) {
    function formatIntegerNumber($number)
    {
        if (Session::has('locale')) {
            $sessionLocale = Session::get('locale');

            if ($sessionLocale !== 'en') {
                return number_format($number, 0, ',', ' ');
            } else {
                return number_format($number, 0, '.', ',');
            }
        } else {
            $appLocale = app()->getLocale();

            if ($appLocale !== 'en') {
                return number_format($number, 0, ',', ' ');
            } else {
                return number_format($number, 0, '.', ',');
            }
        }
    }
}

if (!function_exists("formatDecimalNumber")) {
    function formatDecimalNumber($number)
    {
        if (Session::has('locale')) {
            $sessionLocale = Session::get('locale');

            if ($sessionLocale !== 'en') {
                return number_format($number, 2, ',', ' ');
            } else {
                return number_format($number, 2, '.', ',');
            }
        } else {
            $appLocale = app()->getLocale();

            if ($appLocale !== 'en') {
                return number_format($number, 2, ',', ' ');
            } else {
                return number_format($number, 2, '.', ',');
            }
        }
    }
}
