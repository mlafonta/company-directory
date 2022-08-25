<?php

namespace App\Entity;

use App\Repository\SocialQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocialQuestionRepository::class)]
class SocialQuestion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\OneToMany(mappedBy: 'social_question', targetEntity: UserSocialQuestion::class)]
    private Collection $userSocialQuestions;

    public function __construct()
    {
        $this->userSocialQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection<int, UserSocialQuestion>
     */
    public function getUserSocialQuestions(): Collection
    {
        return $this->userSocialQuestions;
    }

    public function addUserSocialQuestion(UserSocialQuestion $userSocialQuestion): self
    {
        if (!$this->userSocialQuestions->contains($userSocialQuestion)) {
            $this->userSocialQuestions->add($userSocialQuestion);
            $userSocialQuestion->setSocialQuestion($this);
        }

        return $this;
    }

    public function removeUserSocialQuestion(UserSocialQuestion $userSocialQuestion): self
    {
        if ($this->userSocialQuestions->removeElement($userSocialQuestion)) {
            // set the owning side to null (unless already changed)
            if ($userSocialQuestion->getSocialQuestion() === $this) {
                $userSocialQuestion->setSocialQuestion(null);
            }
        }

        return $this;
    }
}
