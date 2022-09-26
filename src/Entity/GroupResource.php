<?php

namespace App\Entity;

use App\Repository\GroupResourceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupResourceRepository::class)]
class GroupResource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'groupResources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GroupData $group_data = null;

    #[ORM\ManyToOne(inversedBy: 'groupResources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resource $resource = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupData(): ?GroupData
    {
        return $this->group_data;
    }

    public function setGroupData(?GroupData $group_data): self
    {
        $this->group_data = $group_data;

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
