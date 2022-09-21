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
    private ?GroupData $parent = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?GroupData $child = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?GroupData
    {
        return $this->parent;
    }

    public function setParent(?GroupData $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChild(): ?GroupData
    {
        return $this->child;
    }

    public function setChild(?GroupData $child): self
    {
        $this->child = $child;

        return $this;
    }
}
