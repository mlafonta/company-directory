<?php

namespace App\Service;

use App\DTO\GroupDTO;
use App\Repository\GroupRepository;
//use App\Repository\ParentChildRepository;

class GroupService
{
    private GroupRepository $groupRepository;
//    private ParentChildRepository $parentChildRepository;

    public function __construct(
        GroupRepository $groupRepository,
//        ParentChildRepository $parentChildRepository
    ){
        $this->groupRepository = $groupRepository;
//        $this->parentChildRepository = $parentChildRepository;
    }
//    /**
//     * @return GroupDTO[]
//     */
//    public function getAllGroups(): array
//    {
//        $groups = $this->groupRepository->getAllGroups();
//        $groupDTOs = [];
//        foreach ($groups as $group) {
//            $group->setParent($this->parentChildRepository->findParentIdByChildId($group->getId()));
//            $group->setChildren($this->parentChildRepository->findChildrenIdsByParentId($group->getId()));
//            if (!$group->getParent()) { //unhardcode these
//                $group->setType('company');
//            } elseif (!$group->getChildren()) {
//                $group->setType('team');
//            } else {
//                $group->setType('department');
//            }
//        }
//        return $groupDTOs;
//    }
}