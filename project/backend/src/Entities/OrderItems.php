<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "order_items")]
class OrderItems extends BaseEntityWithTimestamps
{
    public function __construct(
        #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: "orders")]
        #[ORM\JoinColumn(name: "order_id", referencedColumnName: "id", nullable: false)]
        private Order $order,

        #[ORM\Column(type: "string", length: 20)]
        private int $orderType,

        #[ORM\Column(type: "integer", name: "package_procedure_id")]
        private int $packageProcedureId,

        ?int $id = null)
    {
        parent::__construct($id);

        $this->order = $order;

        $this->orderType = $orderType;

        $this->packageProcedureId = $packageProcedureId;
    }
}