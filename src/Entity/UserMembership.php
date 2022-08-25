<?php

namespace App\Entity;

use App\Repository\UserMembershipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserMembershipRepository::class)]
class UserMembership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userMemberships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userMemberships')]
    #[ORM\JoinColumn(nullable: false)]
    private ?membership $membership = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMembership(): ?membership
    {
        return $this->membership;
    }

    public function setMembership(?membership $membership): self
    {
        $this->membership = $membership;

        return $this;
    }
}
