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
    /**
     * @return GroupDTO[]
     */
    public function getAllGroups(): array
    {
       $groups = $this->groupRepository->getAllGroups();
       foreach ($groups as $group) {
           $this->addMembers($group);
           $this->addParentAndChildren($group);
       }
       foreach ($groups as $group) {
           $this->addType($group);
       }
       return $groups;
    }

    public function getGroupById(int $id): GroupDTO | null
    {
        $group = $this->groupRepository->getOneById($id);
        if ($group) {
            $this->addMembers($group);
            $this->addParentAndChildren($group);
            $this->addType($group);
            return $group;
        } else {
            return null;
        }
    }

    private function addParentAndChildren(GroupDTO $group): void
    {
        $parent = $this->parentChildRepository->findParentIdByChildId($group->getId());
        if ($parent) {
            $group->setParent($this->groupRepository->getOneById($parent));
        }

        $childArray = $this->parentChildRepository->findChildrenIdsByParentId($group->getId());
        $simpleChildArray = array();
        $childDTOarray = array();
        foreach ($childArray as $child){
            $simpleChildArray[] = $child['1'];
        }
        foreach ($simpleChildArray as $child) {
            array_push($childDTOarray, $this->groupRepository->getOneById($child));
        }
        $group->setChildren($childDTOarray);
    }

    private function addMembers(?GroupDTO $group): void

    {
        $memberPositionIds = $this->positionRepository->findPositionIdsByGroupId($group->getId());
        $simpleMemberPositionIds = array();
        $memberDTOArray = array();
        foreach ($memberPositionIds as $memberPositionId){
            $simpleMemberPositionIds[] = $memberPositionId['id'];
        }
        foreach ($simpleMemberPositionIds as $memberIds) {
            $positionDTOArray = $this->userRepository->findByPositionId($memberIds);
                foreach ($positionDTOArray as $positionDTO) {
                    array_push($memberDTOArray, $positionDTO);
                }
        }
        $group->setMembers($memberDTOArray);
    }

    /**
     * @param GroupDTO|null $group
     * @return void
     */
    private function addType(?GroupDTO $group): void
    {
        $parent = null;
        if ($group->getParent()) {
            $parent = $this->groupRepository->getOneById($group->getParent()->getId());
        }
        if ($parent) {
            $this->addParentAndChildren($parent);
            if (!$parent->getParent()) {
                $parent->setType(self::TYPE_COMPANY);
            }
        }
        if (!$parent) {
            $group->setType(self::TYPE_COMPANY);
        } elseif ($parent->getType() == self::TYPE_COMPANY || $group->getChildren()) {
            $group->setType(self::TYPE_DEPARTMENT);
        } else {
            $group->setType(self::TYPE_TEAM);
        }
    }
}