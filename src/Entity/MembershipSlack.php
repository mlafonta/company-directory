<?php

namespace App\Entity;

use App\Repository\MembershipSlackRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipSlackRepository::class)]
class MembershipSlack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'membershipSlacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Slack $slack = null;

    public function getId(): ?int
    {
        return $this->id;
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
