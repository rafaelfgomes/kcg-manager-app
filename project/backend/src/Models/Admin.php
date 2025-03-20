<?php

namespace App\Models;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "admins")]
class Admin extends Model
{
    #[ORM\Column(type: "string", length: 150)]
    private string $password;
        
    #[ORM\OneToOne(targetEntity: User::class, inversedBy: "admin")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private User $user;

    public function __construct(string $password, User $user)
    {
        $now = Carbon::now();
        
        $this->password = $password;

        $this->user = $user;

        $this->createdAt = $now;

        $this->updatedAt = $now;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUser()
    {
        return $this->user;
    }
}