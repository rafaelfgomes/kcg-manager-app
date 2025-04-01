<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "procedures")]
class Procedure extends BaseEntityWithTimestamps
{
    public function __construct(
        #[ORM\Column(type: "string", length: 150)]
        private string $name,

        #[ORM\Column(type: "decimal", precision: 8, scale: 2)]
        private float $price,

        #[ORM\ManyToMany(targetEntity: Package::class, mappedBy: "procedures")]
        private Collection $packages = new ArrayCollection(),

        ?int $id = null)
    {
        parent::__construct($id);

        $this->name = $name;

        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPackages(): Collection
    {
        return $this->packages;
    }

    public function addPackage(Package $package): void
    {
        if (! $this->packages->contains($package)) {
            $this->packages->add($package);
        }
    }
}