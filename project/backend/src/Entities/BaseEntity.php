<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntity
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: "integer")]
    protected ?int $id = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }
}