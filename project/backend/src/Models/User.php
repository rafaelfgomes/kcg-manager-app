<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: "integer")]
        private int $id,
        #[ORM\Column(type: "string", length: 70)]
        private string $name,
        #[ORM\Column(type: "string", length: 50, unique: true)]
        private string $email,
        #[ORM\Column(type: "datetime", name: "created_at")]
        private DateTime $createdAt,
        #[ORM\Column(type: "datetime", name: "updated_at")]
        private DateTime $updatedAt,
        #[ORM\Column(type: "datetime", name: "deleted_at", nullable: true)]
        private DateTime $deletedAt,
        #[ORM\OneToOne(targetEntity: Admin::class, mappedBy: "user", cascade: ["persist", "remove"])]
        private ?Admin $admin = null
    ) {
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }
}