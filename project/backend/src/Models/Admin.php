<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "admins")]
class Admin
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: "integer")]
        private int $id,
        #[ORM\Column(type: "string", length: 150)]
        private string $password,
        #[ORM\Column(type: "datetime", name: "created_at")]
        private DateTime $createdAt,
        #[ORM\Column(type: "datetime", name: "updated_at")]
        private DateTime $updatedAt,
        #[ORM\Column(type: "datetime", name: "deleted_at", nullable: true)]
        private DateTime $deletedAt,
        #[ORM\OneToOne(targetEntity: User::class, inversedBy: "admin")]
        #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE")]
        private User $user
    ) {
    }
}