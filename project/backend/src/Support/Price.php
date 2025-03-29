<?php

namespace App\Support;

class Price
{
    public static function convertToString(float $price)
    {
        return number_format($price, 2, ',', '.');
    }

    public static function convertToFloat(string $price)
    {
        return number_format(floatval($price), 2);
    }
}