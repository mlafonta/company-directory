<?php

namespace App\Entity;

use App\Repository\ResourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResourceRepository::class)]
class Resource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'resources')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;


    #[ORM\Column]
    private ?bool $active = null;


    #[ORM\OneToMany(mappedBy: 'resource', targetEntity: GroupResource::class)]
    private Collection $groupResources;

    public function __construct()
    {
        $this->groupResources = new ArrayCollection();
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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
            $groupResource->setResource($this);
        }

        return $this;
    }

    public function removeGroupResource(GroupResource $groupResource): self
    {
        if ($this->groupResources->removeElement($groupResource)) {
            // set the owning side to null (unless already changed)
            if ($groupResource->getResource() === $this) {
                $groupResource->setResource(null);
            }
        }

        return $this;
    }
}
