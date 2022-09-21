<?php

namespace App\Entity;

use App\Repository\GroupSlackRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupSlackRepository::class)]
class GroupSlack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'groupSlacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GroupData $group = null;

    #[ORM\ManyToOne(inversedBy: 'groupSlacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Slack $slack = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroup(): ?GroupData
    {
        return $this->group;
    }

    public function setGroup(?GroupData $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function getSlack(): ?Slack
    {
        return $this->slack;
    }

    public function setSlack(?Slack $slack): self
    {
        $this->slack = $slack;

        return $this;
    }
}
