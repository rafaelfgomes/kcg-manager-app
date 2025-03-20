<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

abstract class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected ?int $id = null;

    #[ORM\Column(type: "datetime", name: "created_at")]
    protected DateTime $createdAt;

    #[ORM\Column(type: "datetime", name: "updated_at")]
    protected DateTime $updatedAt;
    
    #[ORM\Column(type: "datetime", name: "deleted_at", nullable: true)]
    protected ?DateTime $deletedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
}