<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "packages")]
class Package extends BaseEntity
{
    public function __construct(
        #[ORM\Column(type: "string", length: 150)]
        private string $name,

        #[ORM\Column(type: "integer")]
        private int $sessions,

        #[ORM\Column(type: "decimal", precision: 8, scale: 2)]
        private string $price,

        ?int $id = null)
    {
        parent::__construct($id);

        $this->name = $name;

        $this->sessions = $sessions;

        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSessions()
    {
        return $this->sessions;
    }

    public function getPrice()
    {
        return $this->price;
    }
}