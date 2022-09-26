<?php

namespace App\DTO;

class GroupDTO
{
    private int $id = 0;
    private string $name = '';
    private string $description = '';
    private string $type = '';
    private ?int $lead = null;
    private ?int $parent = null;
    private ?array $children = null;

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
     * @return int
     */
    public function getParent(): int | null
    {
        return $this->parent;
    }

    /**
     * @param int $parent
     */
    public function setParent(int $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return array
     */
    public function getChildren(): array | null
    {
        return $this->children;
    }

    /**
     * @param array $children
     */
    public function setChildren(array $children): void
    {
        $this->children = $children;
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
     * @return int
     */
    public function getLead(): int
    {
        return $this->lead;
    }

    /**
     * @param int $lead
     */
    public function setLead(int $lead): void
    {
        $this->lead = $lead;
    }
}