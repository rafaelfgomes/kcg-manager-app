<?php

namespace App\Models;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User extends Model
{
    #[ORM\Column(type: "string", length: 70)]
    private string $name;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    private string $email;
    
    #[ORM\OneToOne(targetEntity: Admin::class, mappedBy: "user", cascade: ["persist", "remove"])]
    private ?Admin $admin = null;

    public function __construct(string $name, string $email)
    {
        $now = Carbon::now();

        $this->name = $name;

        $this->email = $email;
        
        $this->createdAt = $now;
        
        $this->updatedAt = $now;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getAdmin(): ?Admin {
        return $this->admin;
    }
}