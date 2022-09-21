<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupRepository::class)]
class GroupData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;


    #[ORM\OneToMany(mappedBy: 'group', targetEntity: GroupResource::class)]
    private Collection $groupResources;

    #[ORM\OneToMany(mappedBy: 'group', targetEntity: GroupSlack::class)]
    private Collection $groupSlacks;


    #[ORM\OneToMany(mappedBy: 'group', targetEntity: Position::class)]
    private Collection $positions;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: ParentChild::class)]
    private Collection $parentChildren;


    public function __construct()
    {
        $this->groupResources = new ArrayCollection();
        $this->groupSlacks = new ArrayCollection();
        $this->positions = new ArrayCollection();
        $this->parentChildren = new ArrayCollection();
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

    /**
     * @return Collection<int, Position>
     */
    public function getPositions(): Collection
    {
        return $this->positions;
    }

    public function addPosition(Position $position): self
    {
        if (!$this->positions->contains($position)) {
            $this->positions->add($position);
            $position->setGroup($this);
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->positions->removeElement($position)) {
            // set the owning side to null (unless already changed)
            if ($position->getGroup() === $this) {
                $position->setGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ParentChild>
     */
    public function getParentChildren(): Collection
    {
        return $this->parentChildren;
    }

    public function addParentChild(ParentChild $parentChild): self
    {
        if (!$this->parentChildren->contains($parentChild)) {
            $this->parentChildren->add($parentChild);
            $parentChild->setParent($this);
        }

        return $this;
    }

    public function removeParentChild(ParentChild $parentChild): self
    {
        if ($this->parentChildren->removeElement($parentChild)) {
            // set the owning side to null (unless already changed)
            if ($parentChild->getParent() === $this) {
                $parentChild->setParent(null);
            }
        }

        return $this;
    }
}
