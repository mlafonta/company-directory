<?php

namespace App\Entity;

use App\Repository\ParentChildRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParentChildRepository::class)]
class ParentChild
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'parentChildren')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $parent = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $child = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?User
    {
        return $this->parent;
    }

    public function setParent(?User $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChild(): ?User
    {
        return $this->child;
    }

    public function setChild(?User $child): self
    {
        $this->child = $child;

        return $this;
    }
}
