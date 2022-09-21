<?php

namespace App\Entity;

use App\Entity\Product\Rate;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cette adresse email est déjà utilisée')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 5,
        max: 180,
        minMessage: 'L\'adresse email doit faire au moins {{ limit }} caractères',
        maxMessage: 'L\'adresse email doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/',
        message: 'L\'adresse email n\'est pas valide',
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    private ?string $plainPassword = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le nom doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le nom doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\' -]+$/',
        message: 'Le nom n\'est pas valide',
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le prénom doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le prénom doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\' -]+$/',
        message: 'Le prénom n\'est pas valide',
    )]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'L\'adresse doit faire au moins {{ limit }} caractères',
        maxMessage: 'L\'adresse doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9À-ÿ\' -]+$/',
        message: 'L\'adresse n\'est pas valide',
    )]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Le nom de la ville doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le nom de la ville doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\' -]+$/',
        message: 'Le nom de la ville n\'est pas valide',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'Le code postal doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le code postal doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[0-9]{5}$/',
        message: 'Le code postal n\'est pas valide',
    )]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le pays doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le pays doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\' -]+$/',
        message: 'Le pays n\'est pas valide',
    )]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        min: 10,
        max: 255,
        minMessage: 'Le numéro de téléphone doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le numéro de téléphone doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Regex(
        pattern: '/^(\+33 |0)[1-9]( \d\d){4}$/',
        message: 'Le numéro de téléphone n\'est pas valide',
    )]
    private ?string $phone = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPro = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[0-9]([-. ]{14}$/',
        message: 'Le numéro de SIRET n\'est pas valide',
    )]
    private ?string $idpro = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\' -]+$/',
        message: 'Le nom de la société n\'est pas valide',
    )]
    private ?string $companyname = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isNewsletterOk = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $googleId;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $avatar;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Rate::class)]
    private Collection $rates;

    #[ORM\Column(type: 'boolean')]
    private ?bool $isVerified = false;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gender = null;

    public function __construct()
    {
        $this->rates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

        /**
     * Get the value of plainPassword
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return self
     */
    public function setPlainPassword(?string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function isIsPro(): ?bool
    {
        return $this->isPro;
    }

    public function setIsPro(?bool $isPro): self
    {
        $this->isPro = $isPro;

        return $this;
    }

    public function getIdpro(): ?string
    {
        return $this->idpro;
    }

    public function setIdpro(?string $idpro): self
    {
        $this->idpro = $idpro;

        return $this;
    }

    public function getCompanyname(): ?string
    {
        return $this->companyname;
    }

    public function setCompanyname(?string $companyname): self
    {
        $this->companyname = $companyname;

        return $this;
    }

    public function isIsNewsletterOk(): ?bool
    {
        return $this->isNewsletterOk;
    }

    public function setIsNewsletterOk(?bool $isNewsletterOk): self
    {
        $this->isNewsletterOk = $isNewsletterOk;

        return $this;
    }

    /**
     * @return Collection<int, Rate>
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates->add($rate);
            $rate->setUser($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getUser() === $this) {
                $rate->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of googleId
     */
    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    /**
     * Set the value of googleId
     *
     * @return  self
     */
    public function setGoogleId(?string $googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get the value of avatar
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */
    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
