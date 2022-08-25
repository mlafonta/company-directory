<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupRepository::class)]
class Group
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'groups')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GroupType $group_type = null;

    #[ORM\OneToMany(mappedBy: 'group', targetEntity: GroupResource::class)]
    private Collection $groupResources;

    #[ORM\OneToMany(mappedBy: 'group', targetEntity: GroupSlack::class)]
    private Collection $groupSlacks;

    public function __construct()
    {
        $this->groupResources = new ArrayCollection();
        $this->groupSlacks = new ArrayCollection();
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

    public function getGroupType(): ?GroupType
    {
        return $this->group_type;
    }

    public function setGroupType(?GroupType $group_type): self
    {
        $this->group_type = $group_type;

        return $this;
    }

    /**
     * @return Collection<int, GroupResource>
     */
    public function getGroupResources(): Collection
    {
        return $this->groupResources;
    }

    public function addGroupResource(GroupResource $groupResource): self
    {
        if (!$this->groupResources->contains($groupResource)) {
            $this->groupResources->add($groupResource);
            $groupResource->setGroups($this);
        }

        return $this;
    }

    public function removeGroupResource(GroupResource $groupResource): self
    {
        if ($this->groupResources->removeElement($groupResource)) {
            // set the owning side to null (unless already changed)
            if ($groupResource->getGroups() === $this) {
                $groupResource->setGroups(null);
            }
        }

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
            $groupSlack->setGroup($this);
        }

        return $this;
    }

    public function removeGroupSlack(GroupSlack $groupSlack): self
    {
        if ($this->groupSlacks->removeElement($groupSlack)) {
            // set the owning side to null (unless already changed)
            if ($groupSlack->getGroup() === $this) {
                $groupSlack->setGroup(null);
            }
        }

        return $this;
    }
}
