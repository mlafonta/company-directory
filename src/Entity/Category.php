<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Resource::class)]
    private Collection $resources;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Slack::class)]
    private Collection $slacks;

    public function __construct()
    {
        $this->resources = new ArrayCollection();
        $this->slacks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

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
     * @return Collection<int, Resource>
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resource $resource): self
    {
        if (!$this->resources->contains($resource)) {
            $this->resources->add($resource);
            $resource->setCategory($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resources->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getCategory() === $this) {
                $resource->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Slack>
     */
    public function getSlacks(): Collection
    {
        return $this->slacks;
    }

    public function addSlack(Slack $slack): self
    {
        if (!$this->slacks->contains($slack)) {
            $this->slacks->add($slack);
            $slack->setCategory($this);
        }

        return $this;
    }

    public function removeSlack(Slack $slack): self
    {
        if ($this->slacks->removeElement($slack)) {
            // set the owning side to null (unless already changed)
            if ($slack->getCategory() === $this) {
                $slack->setCategory(null);
            }
        }

        return $this;
    }
}
