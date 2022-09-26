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
           $lead = $this->userRepository->findIdByPositionId($this->positionRepository->findGroupLeadIdByGroupId($group->getId()));
           if ($lead) {
               $group->setLead($lead);
           }
           $this->parentChildRepository->addParentAndChildren($group);
       }
       foreach ($groups as $group) {
           $parent = $this->groupRepository->getOneById($group->getParent());
           if($parent){
               $this->parentChildRepository->addParentAndChildren($parent);
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
       return $groups;
    }
}