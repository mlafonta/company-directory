<?php

namespace App\Entity;

use App\Repository\PronounRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PronounRepository::class)]
class Pronoun
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pronouns = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPronouns(): ?string
    {
        return $this->pronouns;
    }

    public function setPronouns(string $pronouns): self
    {
        $this->pronouns = $pronouns;

        return $this;
    }
}
