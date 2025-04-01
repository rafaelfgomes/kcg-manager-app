<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "packages")]
class Package extends BaseEntityWithTimestamps
{
    public function __construct(
        #[ORM\Column(type: "string", length: 150)]
        private string $name,

        #[ORM\Column(type: "integer")]
        private int $sessions,

        #[ORM\Column(type: "decimal", precision: 8, scale: 2)]
        private float $price,

        #[ORM\ManyToMany(targetEntity: Procedure::class, inversedBy: "packages")]
        #[ORM\JoinTable(name: "packages_procedures")]
        private Collection $procedures = new ArrayCollection(),

        ?int $id = null)
    {
        parent::__construct($id);

        $this->name = $name;

        $this->sessions = $sessions;

        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSessions(): int
    {
        return $this->sessions;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getProcedures(): Collection
    {
        return $this->procedures;
    }

    public function addProcedure(Procedure $procedure): void
    {
        if (! $this->procedures->contains($procedure)) {
            $this->procedures->add($procedure);

            $procedure->addPackage($this);
        }
    }
}