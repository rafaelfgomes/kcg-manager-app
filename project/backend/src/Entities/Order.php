<?php

namespace App\Entities;

use Carbon\Carbon;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "orders")]
class Order extends BaseEntity
{
    public function __construct(
        #[ORM\Column(type: "decimal", precision: 8, scale: 2)]
        private string $totalPrice,

        #[ORM\Column(type: "datetime", name: "created_at")]
        private DateTime $createdAt,

        #[ORM\Column(type: "datetime", name: "paid_at", nullable: true)]
        private ?DateTime $paidAt = null,
    
        #[ORM\Column(type: "datetime", name: "updated_at", nullable: true)]
        private ?DateTime $updatedAt = null,

        #[ORM\OneToMany(mappedBy: "order", targetEntity: OrderItems::class, cascade: ["persist", "remove"])]
        private Collection $orderItems = new ArrayCollection(),

        ?int $id = null)
    {
        parent::__construct($id);

        $this->totalPrice = $totalPrice;

        $this->createdAt = Carbon::now();
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getPaidAt(): ?DateTime
    {
        return $this->paidAt;
    }
}