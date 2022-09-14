<?php

namespace App\Entity;

use App\Repository\MembershipResourceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipResourceRepository::class)]
class MembershipResource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'membershipResources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?resource $resource = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResource(): ?resource
    {
        return $this->resource;
    }

    public function setResource(?resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }
}
