<?php

namespace App\Entity\Communication;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\Communication\NewsLetterUserRepository;

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
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/',
        message: 'L\'adresse email n\'est pas valide',
    )]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $uuid;

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

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
