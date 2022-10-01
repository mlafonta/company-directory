<?php

namespace App\DTO;

class UserDTO
{
    private int $id = 0;
    private string $name = '';
    private string $position = '';
    private bool $isLead = false;

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


}