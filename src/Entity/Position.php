<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PositionRepository::class)]
class Position
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $is_lead = null;

    #[ORM\ManyToOne(inversedBy: 'positions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GroupData $group = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function isIsLead(): ?bool
    {
        return $this->is_lead;
    }

    public function setIsLead(bool $is_lead): self
    {
        $this->is_lead = $is_lead;

        return $this;
    }

    public function getGroup(): ?GroupData
    {
        return $this->group;
    }

    public function setGroup(?GroupData $group): self
    {
        $this->group = $group;

        return $this;
    }
}
