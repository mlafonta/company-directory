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

    #[ORM\OneToMany(mappedBy: 'group_data', targetEntity: GroupResource::class)]
    private Collection $groupResources;

    #[ORM\OneToMany(mappedBy: 'group_data', targetEntity: Position::class)]
    private Collection $positions;



    public function __construct()
    {
        $this->groupResources = new ArrayCollection();
        $this->positions = new ArrayCollection();
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
            $groupResource->setGroupData($this);
        }

        return $this;
    }

    public function removeGroupResource(GroupResource $groupResource): self
    {
        if ($this->groupResources->removeElement($groupResource)) {
            // set the owning side to null (unless already changed)
            if ($groupResource->getGroupData() === $this) {
                $groupResource->setGroupData(null);
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
            $position->setGroupData($this);
        }

        return $this;
    }

    public function removePosition(Position $position): self
    {
        if ($this->positions->removeElement($position)) {
            // set the owning side to null (unless already changed)
            if ($position->getGroupData() === $this) {
                $position->setGroupData(null);
            }
        }

        return $this;
    }
}
