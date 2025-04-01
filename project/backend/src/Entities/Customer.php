<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "customers")]
class Customer extends BaseEntityWithTimestamps
{
    public function __construct(
        #[ORM\Column(type: "string", length: 80)]
        private string $name,
        
        #[ORM\Column(type: "string", length: 50, unique: true)]
        private string $email,
        
        #[ORM\OneToMany(mappedBy: "customer", targetEntity: Phone::class, cascade: ["persist", "remove"])]
        private Collection $phones = new ArrayCollection(),

        ?int $id = null)
    {
        parent::__construct($id);

        $this->name = $name;

        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): void
    {
        $this->phones->add($phone);
    }
}