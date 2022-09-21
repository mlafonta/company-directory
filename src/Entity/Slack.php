<?php

namespace App\Entity;

use App\Repository\SlackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlackRepository::class)]
class Slack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $channel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $topic = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'slacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?category $category = null;

    #[ORM\OneToMany(mappedBy: 'slack', targetEntity: GroupSlack::class)]
    private Collection $groupSlacks;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'slack', targetEntity: MembershipSlack::class)]
    private Collection $membershipSlacks;

    public function __construct()
    {
        $this->groupSlacks = new ArrayCollection();
        $this->membershipSlacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(?string $topic): self
    {
        $this->topic = $topic;

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

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, GroupSlack>
     */
    public function getGroupSlacks(): Collection
    {
        return $this->groupSlacks;
    }

    public function addGroupSlack(GroupSlack $groupSlack): self
    {
        if (!$this->groupSlacks->contains($groupSlack)) {
            $this->groupSlacks->add($groupSlack);
            $groupSlack->setSlack($this);
        }

        return $this;
    }

    public function removeGroupSlack(GroupSlack $groupSlack): self
    {
        if ($this->groupSlacks->removeElement($groupSlack)) {
            // set the owning side to null (unless already changed)
            if ($groupSlack->getSlack() === $this) {
                $groupSlack->setSlack(null);
            }
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, MembershipSlack>
     */
    public function getMembershipSlacks(): Collection
    {
        return $this->membershipSlacks;
    }

    public function addMembershipSlack(MembershipSlack $membershipSlack): self
    {
        if (!$this->membershipSlacks->contains($membershipSlack)) {
            $this->membershipSlacks->add($membershipSlack);
            $membershipSlack->setSlack($this);
        }

        return $this;
    }

    public function removeMembershipSlack(MembershipSlack $membershipSlack): self
    {
        if ($this->membershipSlacks->removeElement($membershipSlack)) {
            // set the owning side to null (unless already changed)
            if ($membershipSlack->getSlack() === $this) {
                $membershipSlack->setSlack(null);
            }
        }

        return $this;
    }
}
