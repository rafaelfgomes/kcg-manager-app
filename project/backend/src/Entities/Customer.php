<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "customers")]
class Customer extends BaseEntity
{
    public function __construct(
        #[ORM\Column(type: "string", length: 70)]
        private string $name,
        
        #[ORM\Column(type: "string", length: 50, unique: true)]
        private string $email,
        
        #[ORM\OneToMany(mappedBy: "customer", targetEntity: Phone::class, cascade: ["persist", "remove"])]
        private iterable $phones = new ArrayCollection(),

        ?int $id = null)
    {
        parent::__construct($id);

        $this->name = $name;

        $this->email = $email;

        $this->phones = $phones;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPhones(): iterable
    {
        return $this->phones;
    }
}