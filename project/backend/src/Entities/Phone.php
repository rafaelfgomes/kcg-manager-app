<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "phones")]
class Phone extends BaseEntity
{
    public function __construct(
        #[ORM\Column(type: "integer")]
        private int $country,

        #[ORM\Column(type: "integer", nullable: true)]
        private int $code,

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

    public function getCountryCode(): int
    {
        return $this->country;
    }

    public function getLocalCode(): int
    {
        return $this->code;
    }

    public function getPhoneNumber(): string
    {
        return $this->number;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }
}