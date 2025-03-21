<?php

namespace App\DTO\Phone;

use App\Entities\Customer;
use App\Entities\Phone;

class PhoneDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $country,
        public readonly int $local,
        public readonly string $number
    ) {}

    public static function fillEntity(array $data, Customer $customer): Phone
    {
        return new Phone(
            country: $data['country'],
            code: $data['code'] ?? null,
            number: $data['number'],
            customer: $customer,
            id: $data['id'] ?? null
        );
    }

    public static function fullPhoneNumber(Phone $phone): string
    {
        $phoneMask = '+%d %d %s';

        return sprintf(
            $phoneMask,
            $phone->getCountryCode(),
            $phone->getLocalCode(),
            self::formatPhoneNumber($phone->getPhoneNumber())
        );
    }

    private static function formatPhoneNumber(string $phoneNumber) {
        $firstPhonePart = substr($phoneNumber, 0, 5);

        $secondPhonePart = substr($phoneNumber, -4);

        return sprintf('%s-%s', $firstPhonePart, $secondPhonePart);
    }
}