<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "admins")]
class Admin extends BaseEntity
{
    public function __construct(
        #[ORM\Column(type: "string", length: 150)]
        private string $name,

        #[ORM\Column(type: "string", length: 50, unique: true)]
        private string $email,

        #[ORM\Column(type: "string", length: 150)]
        private string $password,

        ?int $id = null)
    {
        parent::__construct($id);

        $this->name = $name;

        $this->email = $email;
        
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
}