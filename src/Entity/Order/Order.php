<?php

namespace App\Entity\Order;

use App\Entity\User;
use App\Entity\Address;
use App\Entity\Product\Custom;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Order\OrderRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reference = null;

    #[ORM\Column(nullable: true)]
    private ?int $state = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'myOrder', targetEntity: OrderDetails::class)]
    private Collection $orderDetails;

    #[ORM\OneToMany(mappedBy: 'orderShipping', targetEntity: Shipping::class)]
    private Collection $shipping;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    private ?Address $adress = null;

    #[ORM\OneToMany(mappedBy: 'customOrder', targetEntity: Custom::class)]
    private Collection $customs;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trackingOrder = null;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
        $this->shipping = new ArrayCollection();
        $this->customs = new ArrayCollection();
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getOrderDetails()->getValues() as $product) {
            $total += ($product->getPrice() * $product->getQuantity());
        }
        return $total;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, OrderDetails>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetails $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setMyOrder($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetails $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getMyOrder() === $this) {
                $orderDetail->setMyOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Shipping>
     */
    public function getShipping(): Collection
    {
        return $this->shipping;
    }

    public function addShipping(Shipping $shipping): self
    {
        if (!$this->shipping->contains($shipping)) {
            $this->shipping->add($shipping);
            $shipping->setOrderShipping($this);
        }

        return $this;
    }

    public function removeShipping(Shipping $shipping): self
    {
        if ($this->shipping->removeElement($shipping)) {
            // set the owning side to null (unless already changed)
            if ($shipping->getOrderShipping() === $this) {
                $shipping->setOrderShipping(null);
            }
        }

        return $this;
    }

    public function getAdress(): ?Address
    {
        return $this->adress;
    }

    public function setAdress(?Address $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection<int, Custom>
     */
    public function getCustoms(): Collection
    {
        return $this->customs;
    }

    public function addCustom(Custom $custom): self
    {
        if (!$this->customs->contains($custom)) {
            $this->customs->add($custom);
            $custom->setCustomOrder($this);
        }

        return $this;
    }

    public function removeCustom(Custom $custom): self
    {
        if ($this->customs->removeElement($custom)) {
            // set the owning side to null (unless already changed)
            if ($custom->getCustomOrder() === $this) {
                $custom->setCustomOrder(null);
            }
        }

        return $this;
    }

    public function getTrackingOrder(): ?string
    {
        return $this->trackingOrder;
    }

    public function setTrackingOrder(?string $trackingOrder): self
    {
        $this->trackingOrder = $trackingOrder;

        return $this;
    }
}
