<?php

namespace App\Entity;

use App\Repository\UserSocialQuestionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSocialQuestionRepository::class)]
class UserSocialQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userSocialQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userSocialQuestions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SocialQuestion $social_question = null;

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

    public function getSocialQuestion(): ?SocialQuestion
    {
        return $this->social_question;
    }

    public function setSocialQuestion(?SocialQuestion $social_question): self
    {
        $this->social_question = $social_question;

        return $this;
    }
}
