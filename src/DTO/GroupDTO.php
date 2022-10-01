<?php

namespace App\DTO;

class GroupDTO
{
    private int $id = 0;
    private string $name = '';
    private string $description = '';
    private string $type = '';
    private ?GroupDTO $parent = null;
    private ?array $children = null;
    private ?array $members = null;

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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return GroupDTO|null
     */
    public function getParent(): ?GroupDTO
    {
        return $this->parent;
    }

    /**
     * @param GroupDTO|null $parent
     */
    public function setParent(?GroupDTO $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return array|null
     */
    public function getChildren(): ?array
    {
        return $this->children;
    }

    /**
     * @param array|null $children
     */
    public function setChildren(?array $children): void
    {
        $this->children = $children;
    }

    /**
     * @return array|null
     */
    public function getMembers(): ?array
    {
        return $this->members;
    }

    /**
     * @param array|null $members
     */
    public function setMembers(?array $members): void
    {
        $this->members = $members;
    }


}