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

    #[ORM\Column]
    private ?bool $is_lead = null;

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

    public function isIsLead(): ?bool
    {
        return $this->is_lead;
    }

    public function setIsLead(bool $is_lead): self
    {
        $this->is_lead = $is_lead;

        return $this;
    }
}
