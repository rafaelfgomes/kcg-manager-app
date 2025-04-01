<?php

namespace App\Entities;

use Carbon\Carbon;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

abstract class BaseEntityWithTimestamps extends BaseEntity
{
    public function __construct(
        #[ORM\Column(type: "datetime", name: "created_at")]
        protected DateTime $createdAt,

        #[ORM\Column(type: "datetime", name: "updated_at", nullable: true)]
        protected ?DateTime $updatedAt = null,
        
        #[ORM\Column(type: "datetime", name: "deleted_at", nullable: true)]
        protected ?DateTime $deletedAt = null,
        
        ?int $id = null)
    {
        parent::__construct($id);

        $this->createdAt = Carbon::now();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
}