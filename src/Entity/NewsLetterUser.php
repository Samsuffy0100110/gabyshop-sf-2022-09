<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewsLetterUserRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NewsLetterUserRepository::class)]
class NewsLetterUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'L\'adresse email doit faire au moins {{ limit }} caractères',
        maxMessage: 'L\'adresse email doit faire au maximum {{ limit }} caractères',
    )]
    #[Assert\Email(
        message: 'L\'adresse email n\'est pas valide',
    )]
    #[Assert\Unique]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/',
        message: 'L\'adresse email n\'est pas valide',
    )]
    private ?string $email = null;

    #[ORM\Column(type: 'uuid')]
    private ?Uuid $uuid = null;

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

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
