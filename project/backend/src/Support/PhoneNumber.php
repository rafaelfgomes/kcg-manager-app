<?php

namespace App\Support;

use App\Entities\Phone;

class PhoneNumber
{
    public static function full(Phone $phone): string
    {
        $phoneMask = '+%d %d %s';

        return sprintf(
            $phoneMask,
            $phone->getCountryCode(),
            $phone->getLocalCode(),
            self::format($phone->getPhoneNumber())
        );
    }

    private static function format(string $phoneNumber) {
        $firstPhonePart = substr($phoneNumber, 0, 5);

        $secondPhonePart = substr($phoneNumber, -4);

        return sprintf('%s-%s', $firstPhonePart, $secondPhonePart);
    }
}
