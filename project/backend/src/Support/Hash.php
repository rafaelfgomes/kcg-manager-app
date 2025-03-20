<?php

namespace App\Support;

class Hash
{
    public static function make(string $value, array $options = []): string
    {
        $cost = $options['cost'] ?? 10;
        
        return password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    public static function check(string $value, string $hashedValue): bool
    {
        return password_verify($value, $hashedValue);
    }

    public static function needsRehash(string $hashedValue, array $options = []): bool
    {
        $cost = $options['cost'] ?? 10;

        return password_needs_rehash($hashedValue, PASSWORD_BCRYPT, ['cost' => $cost]);
    }
}
