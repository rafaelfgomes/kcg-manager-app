<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "customers")]
class Customer extends Model
{
    #[ORM\Column(type: "string", length: 70)]
    private string $name;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    private string $email;

    public function __construct(string $name, string $email, ?int $id = null)
    {
        parent::__construct($id);

        $this->name = $name;

        $this->email = $email;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }
}