<?php

namespace App\Entity;

use App\Repository\MembershipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipRepository::class)]
class Membership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'membership', targetEntity: UserMembership::class)]
    private Collection $userMemberships;

    public function __construct()
    {
        $this->userMemberships = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, UserMembership>
     */
    public function getUserMemberships(): Collection
    {
        return $this->userMemberships;
    }

    public function addUserMembership(UserMembership $userMembership): self
    {
        if (!$this->userMemberships->contains($userMembership)) {
            $this->userMemberships->add($userMembership);
            $userMembership->setMembership($this);
        }

        return $this;
    }

    public function removeUserMembership(UserMembership $userMembership): self
    {
        if ($this->userMemberships->removeElement($userMembership)) {
            // set the owning side to null (unless already changed)
            if ($userMembership->getMembership() === $this) {
                $userMembership->setMembership(null);
            }
        }

        return $this;
    }
}
