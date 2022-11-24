<?php

namespace App\Entity\Order;

use Doctrine\DBAL\Types\Types;
use App\Entity\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Order\OrderDetailsRepository;

#[ORM\Entity(repositoryClass: OrderDetailsRepository::class)]
class OrderDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    private ?Order $myOrder = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?float $total = null;

    #[ORM\Column(length: 255)]
    private ?string $taxe = null;

    #[ORM\ManyToOne(inversedBy: 'orderDetails')]
    private ?Product $product = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $primaryOfferName = null;

    #[ORM\Column(nullable: true)]
    private ?int $primaryOfferReduce = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $primaryTypeReduce = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondaryOfferName = null;

    #[ORM\Column(nullable: true)]
    private ?int $secondaryOfferReduce = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondaryTypeReduce = null;
    
    #[ORM\Column(nullable: true)]
    private ?float $customPrice = null;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $customDescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyOrder(): ?Order
    {
        return $this->myOrder;
    }

    public function setMyOrder(?Order $myOrder): self
    {
        $this->myOrder = $myOrder;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function __toString()
    {
        return sprintf('%s x%s', $this->getProduct(), $this->getQuantity());
    }

    public function getTaxe(): ?string
    {
        return $this->taxe;
    }

    public function setTaxe(string $taxe): self
    {
        $this->taxe = $taxe;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getPrimaryOfferName(): ?string
    {
        return $this->primaryOfferName;
    }

    public function setPrimaryOfferName(?string $primaryOfferName): self
    {
        $this->primaryOfferName = $primaryOfferName;

        return $this;
    }

    public function getPrimaryOfferReduce(): ?int
    {
        return $this->primaryOfferReduce;
    }

    public function setPrimaryOfferReduce(?int $primaryOfferReduce): self
    {
        $this->primaryOfferReduce = $primaryOfferReduce;

        return $this;
    }

    public function getPrimaryOfferTypeReduce(): ?string
    {
        return $this->primaryTypeReduce;
    }

    public function setPrimaryOfferTypeReduce(?string $primaryTypeReduce): self
    {
        $this->primaryTypeReduce = $primaryTypeReduce;

        return $this;
    }

    public function getSecondaryOfferName(): ?string
    {
        return $this->secondaryOfferName;
    }

    public function setSecondaryOfferName(?string $secondaryOfferName): self
    {
        $this->secondaryOfferName = $secondaryOfferName;

        return $this;
    }

    public function getSecondaryOfferReduce(): ?int
    {
        return $this->secondaryOfferReduce;
    }

    public function setSecondaryOfferReduce(?int $secondaryOfferReduce): self
    {
        $this->secondaryOfferReduce = $secondaryOfferReduce;

        return $this;
    }

    public function getSecondaryOfferTypeReduce(): ?string
    {
        return $this->secondaryTypeReduce;
    }

    public function setSecondaryOfferTypeReduce(?string $secondaryTypeReduce): self
    {
        $this->secondaryTypeReduce = $secondaryTypeReduce;

        return $this;
    }

    public function getCustomPrice(): ?float
    {
        return $this->customPrice;
    }

    public function setCustomPrice(?float $customPrice): self
    {
        $this->customPrice = $customPrice;
        return $this;
    }

    public function getCustomDescription(): ?string
    {
        return $this->customDescription;
    }

    public function setCustomDescription(?string $customDescription): self
    {
        $this->customDescription = $customDescription;
        return $this;
    }
}
