<?php

namespace App\DTO\Collections;

use App\DTO\Resources\UserDTO;

class UserCollection
{
    public static function list(array $users): array
    {
        $userCollection = [];

        foreach ($users as $user) {
            array_push($userCollection, UserDTO::fromEntity($user));
        }

        return $userCollection;
    }
}