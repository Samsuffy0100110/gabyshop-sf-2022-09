<?php

namespace App\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Product\AttributRepository;

#[ORM\Entity(repositoryClass: AttributRepository::class)]
class Attribut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'attributs', targetEntity: Product::class, cascade: ['persist'])]
    private ?Product $product = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $persoIsEnable = null;

    #[ORM\OneToMany(mappedBy: 'attribut', targetEntity: Custom::class)]
    private Collection $customs;

    public function __construct()
    {
        $this->customs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
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

    public function isPersoIsEnable(): ?bool
    {
        return $this->persoIsEnable;
    }

    public function setPersoIsEnable(?bool $persoIsEnable): self
    {
        $this->persoIsEnable = $persoIsEnable;

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
            $custom->setAttribut($this);
        }

        return $this;
    }

    public function removeCustom(Custom $custom): self
    {
        if ($this->customs->removeElement($custom)) {
            // set the owning side to null (unless already changed)
            if ($custom->getAttribut() === $this) {
                $custom->setAttribut(null);
            }
        }

        return $this;
    }
}
