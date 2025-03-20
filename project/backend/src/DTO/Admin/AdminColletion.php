<?php

namespace App\DTO\Admin;

class AdminCollection
{
    public static function list(array $admins): array
    {
        $adminCollection = [];

        foreach ($admins as $admin) {
            array_push($adminCollection, AdminDTO::fillDatafromEntity($admin));
        }

        return $adminCollection;
    }
}