<?php

namespace App\DTO;

class UserDTO
{
    private int $id = 0;
    private string $name = '';
    private string $email = '';
    private string $pronouns = '';
    private string $image = '';
    private string $position = '';
    private string $timeAtKipsu = '';
    private string $slack_link = '';
    private bool $isLead = false;
    private ?GroupDTO $group = null;
    private ?UserDTO $supervisor = null;
    private array $reports = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return bool
     */
    public function isLead(): bool
    {
        return $this->isLead;
    }

    /**
     * @param bool $isLead
     */
    public function setIsLead(bool $isLead): void
    {
        $this->isLead = $isLead;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPronouns(): string
    {
        return $this->pronouns;
    }

    /**
     * @param string $pronouns
     */
    public function setPronouns(string $pronouns): void
    {
        $this->pronouns = $pronouns;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getTimeAtKipsu(): string
    {
        return $this->timeAtKipsu;
    }

    /**
     * @param string $timeAtKipsu
     */
    public function setTimeAtKipsu(string $timeAtKipsu): void
    {
        $this->timeAtKipsu = $timeAtKipsu;
    }

    /**
     * @return string
     */
    public function getSlackLink(): string
    {
        return $this->slack_link;
    }

    /**
     * @param string $slack_link
     */
    public function setSlackLink(string $slack_link): void
    {
        $this->slack_link = $slack_link;
    }

    /**
     * @return GroupDTO|null
     */
    public function getGroup(): ?GroupDTO
    {
        return $this->group;
    }

    /**
     * @param GroupDTO|null $group
     */
    public function setGroup(?GroupDTO $group): void
    {
        $this->group = $group;
    }

    /**
     * @return UserDTO|null
     */
    public function getSupervisor(): ?UserDTO
    {
        return $this->supervisor;
    }

    /**
     * @param UserDTO|null $supervisor
     */
    public function setSupervisor(?UserDTO $supervisor): void
    {
        $this->supervisor = $supervisor;
    }

    /**
     * @return array
     */
    public function getReports(): array
    {
        return $this->reports;
    }

    /**
     * @param array $reports
     */
    public function setReports(array $reports): void
    {
        $this->reports = $reports;
    }


}