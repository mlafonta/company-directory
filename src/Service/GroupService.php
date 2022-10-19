<?php

namespace App\Service;

use App\DTO\GroupDTO;
use App\Repository\GroupRepository;
use App\Repository\ParentChildRepository;
use App\Repository\PositionRepository;
use App\Repository\UserRepository;

class GroupService
{
    const TYPE_COMPANY = 'company';
    const TYPE_DEPARTMENT = 'department';
    const TYPE_TEAM = 'team';

    private GroupRepository $groupRepository;
    private ParentChildRepository $parentChildRepository;
    private PositionRepository $positionRepository;
    private UserRepository $userRepository;

    public function __construct(
        GroupRepository $groupRepository,
        ParentChildRepository $parentChildRepository,
        PositionRepository $positionRepository,
        UserRepository $userRepository
    ){
        $this->groupRepository = $groupRepository;
        $this->parentChildRepository = $parentChildRepository;
        $this->positionRepository = $positionRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllGroups(): array
    {
       $groupDTOs = $this->groupRepository->findAllGroups();
       foreach ($groupDTOs as $groupDTO) {
           $this->addDTOValues($groupDTO);
       }
       usort($groupDTOs, array($this, 'comparator'));
       return $groupDTOs;
    }

    public function getGroupById(int $groupId): GroupDTO | null
    {
        $groupDTO = $this->groupRepository->findGroupById($groupId);
        if ($groupDTO) {
            $this->addDTOValues($groupDTO);
            return $groupDTO;
        } else {
            return null;
        }
    }

    private function addDTOValues(GroupDTO $groupDTO): void
    {
        $this->addChildren($groupDTO);
        $this->addMembers($groupDTO);
        $this->addParent($groupDTO);
        $this->addType($groupDTO);
    }

    private function addChildren(GroupDTO $groupDTO): void
    {
        $childIds = $this->parentChildRepository->findChildIdsByParentId($groupDTO->getId());
        $filteredChildIds = array();
        $childDTOs = array();
        foreach ($childIds as $childId) {
            $filteredChildIds[] = $childId['1'];
        }
        foreach ($filteredChildIds as $filteredChildId) {
            array_push($childDTOs, $this->groupRepository->findGroupById($filteredChildId));
        }
        $groupDTO->setChildren($childDTOs);
    }

    private function addParent(GroupDTO $groupDTO): void
    {
        $parentId = $this->parentChildRepository->findParentIdByChildId($groupDTO->getId());
        if ($parentId) {
            $groupDTO->setParent($this->groupRepository->findGroupById($parentId));
        }
    }

    private function addMembers(?GroupDTO $groupDTO): void
    {
        $memberPositionIds = $this->positionRepository->findPositionIdsByGroupId($groupDTO->getId());
        $filteredMemberPositionIds = array();
        $memberDTOs = array();
        foreach ($memberPositionIds as $memberPositionId){
            $filteredMemberPositionIds[] = $memberPositionId['id'];
        }
        foreach ($filteredMemberPositionIds as $filteredMemberPositionId) {
            $positionDTOs = $this->userRepository->findUsersByPositionId($filteredMemberPositionId);
                if($positionDTOs) {
                    foreach ($positionDTOs as $positionDTO) {
                        array_push($memberDTOs, $positionDTO);
                    }
                }
        }
        $groupDTO->setMembers($memberDTOs);
    }

    private function addType(?GroupDTO $groupDTO): void
    {
        $parentDTO = null;
        if ($groupDTO->getParent()) {
            $parentDTO = $this->groupRepository->findGroupById($groupDTO->getParent()->getId());
        }
        if ($parentDTO) {
            $this->addParent($parentDTO);
            if (!$parentDTO->getParent()) {
                $parentDTO->setType(self::TYPE_COMPANY);
            }
        }
        if (!$parentDTO) {
            $groupDTO->setType(self::TYPE_COMPANY);
        } elseif ($parentDTO->getType() == self::TYPE_COMPANY || $groupDTO->getChildren()) {
            $groupDTO->setType(self::TYPE_DEPARTMENT);
        } else {
            $groupDTO->setType(self::TYPE_TEAM);
        }
    }

    private function comparator(GroupDTO $groupDTO1, GroupDTO $groupDTO2): int
    {
        return strcmp($groupDTO1->getName(), $groupDTO2->getName());
    }
}