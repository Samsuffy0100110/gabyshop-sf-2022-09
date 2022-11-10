<?php

namespace App\Entity\Product;

use App\Entity\Order\Order;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Product\CustomRepository;

#[ORM\Entity(repositoryClass: CustomRepository::class)]
class Custom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'customs')]
    private ?Order $customOrder = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'customs')]
    private ?Attribut $attribut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCustomOrder(): ?Order
    {
        return $this->customOrder;
    }

    public function setCustomOrder(?Order $customOrder): self
    {
        $this->customOrder = $customOrder;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function __toString()
    {
        return $this->attribut . ' / ' .
        'Déscription : ' . '  ' . $this->description . ' / ' .
        'Quantité x' . '  ' . $this->quantity;
    }

    public function getAttribut(): ?Attribut
    {
        return $this->attribut;
    }

    public function setAttribut(?Attribut $attribut): self
    {
        $this->attribut = $attribut;

        return $this;
    }
}
