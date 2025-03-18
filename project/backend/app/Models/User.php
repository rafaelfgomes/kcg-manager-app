<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: "integer")]
        private int $id,
        #[ORM\Column(type: "string", length: 70)]
        private string $name,
        #[ORM\Column(type: "string", length: 50, unique: true)]
        private string $email
    ) {
    }
}