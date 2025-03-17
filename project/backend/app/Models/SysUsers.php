<?php

namespace App\Model;

class SysUsers
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private string $password
    ) {}
}