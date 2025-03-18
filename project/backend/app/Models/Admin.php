<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "admin")]
class Admin
{
    public function __construct(
        private int $user_id,
        #[ORM\Column(type: "string", length: 150)]
        private string $password
    ) {
    }
}