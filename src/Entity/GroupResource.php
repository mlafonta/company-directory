<?php

namespace App\Entity;

use App\Repository\GroupResourceRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Resource;

#[ORM\Entity(repositoryClass: GroupResourceRepository::class)]
class GroupResource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'groupResources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Group $group = null;

    #[ORM\ManyToOne(inversedBy: 'groupResources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resource $resource = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(?Group $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getResource(): ?Resource
    {
        return $this->resource;
    }

    public function setResource(?Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }
}
