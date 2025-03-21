<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "phones")]
class Phone extends BaseEntity
{
    public function __construct(
        #[ORM\Column(type: "integer")]
        private string $country,

        #[ORM\Column(type: "integer", nullable: true)]
        private string $code,

        #[ORM\Column(type: "string", length: 9)]
        private string $number,

        #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: "phones")]
        #[ORM\JoinColumn(name: "customer_id", referencedColumnName: "id", nullable: false)]
        private Customer $customer,

        ?int $id = null)
    {
        parent::__construct($id);

        $this->country = $country;

        $this->code = $code;
        
        $this->number = $number;
    }

    public function getCountryCode()
    {
        return $this->country;
    }

    public function getLocalCode()
    {
        return $this->code;
    }

    public function getPhoneNumber()
    {
        return $this->number;
    }
}