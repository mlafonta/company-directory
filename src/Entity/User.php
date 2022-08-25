<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $slack_username = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne]
    private ?Pronoun $pronoun = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Desk $desk = null;

    #[ORM\OneToMany(mappedBy: 'parent_child', targetEntity: ParentChild::class)]
    private Collection $parentChildren;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserSocialQuestion::class)]
    private Collection $userSocialQuestions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserMembership::class)]
    private Collection $userMemberships;

    public function __construct()
    {
        $this->parentChildren = new ArrayCollection();
        $this->userSocialQuestions = new ArrayCollection();
        $this->userMemberships = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlackUsername(): ?string
    {
        return $this->slack_username;
    }

    public function setSlackUsername(string $slack_username): self
    {
        $this->slack_username = $slack_username;

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


    public function getPronounId(): ?Pronoun
    {
        return $this->pronoun_id;
    }

    public function setPronounId(?Pronoun $pronoun_id): self
    {
        $this->pronoun_id = $pronoun_id;

        return $this;
    }

    public function getDeskId(): ?Desk
    {
        return $this->desk_id;
    }

    public function setDeskId(?Desk $desk_id): self
    {
        $this->desk_id = $desk_id;

        return $this;
    }

    /**
     * @return Collection<int, ParentChild>
     */
    public function getParentChildren(): Collection
    {
        return $this->parentChildren;
    }

    public function addParent(ParentChild $parentChild): self
    {
        if (!$this->parentChildren->contains($parentChild)) {
            $this->parentChildren->add($parentChild);
            $parentChild->setParent($this);
        }

        return $this;
    }

    public function removeParent(ParentChild $parentChild): self
    {
        if ($this->parentChildren->removeElement($parentChild)) {
            // set the owning side to null (unless already changed)
            if ($parentChild->getParent() === $this) {
                $parentChild->setParent(null);
            }
        }

        return $this;
    }

    public function addChild(ParentChild $parentChild): self
    {
        if (!$this->parentChildren->contains($parentChild)) {
            $this->parentChildren->add($parentChild);
            $parentChild->setChild($this);
        }

        return $this;
    }

    public function removeChild(ParentChild $parentChild): self
    {
        if ($this->parentChildren->removeElement($parentChild)) {
            // set the owning side to null (unless already changed)
            if ($parentChild->getChild() === $this) {
                $parentChild->setChild(null);
            }
        }

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
            $userSocialQuestion->setUser($this);
        }

        return $this;
    }

    public function removeUserSocialQuestion(UserSocialQuestion $userSocialQuestion): self
    {
        if ($this->userSocialQuestions->removeElement($userSocialQuestion)) {
            // set the owning side to null (unless already changed)
            if ($userSocialQuestion->getUser() === $this) {
                $userSocialQuestion->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserMembership>
     */
    public function getUserMemberships(): Collection
    {
        return $this->userMemberships;
    }

    public function addUserMembership(UserMembership $userMembership): self
    {
        if (!$this->userMemberships->contains($userMembership)) {
            $this->userMemberships->add($userMembership);
            $userMembership->setUser($this);
        }

        return $this;
    }

    public function removeUserMembership(UserMembership $userMembership): self
    {
        if ($this->userMemberships->removeElement($userMembership)) {
            // set the owning side to null (unless already changed)
            if ($userMembership->getUser() === $this) {
                $userMembership->setUser(null);
            }
        }

        return $this;
    }
}
