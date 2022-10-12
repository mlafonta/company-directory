<?php

namespace App\Service;

use App\DTO\UserDTO;
use App\Repository\GroupRepository;
use App\Repository\ParentChildRepository;
use App\Repository\PositionRepository;
use App\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    private GroupRepository $groupRepository;
    private PositionRepository $positionRepository;
    private ParentChildRepository $parentChildRepository;

    public function __construct(
        UserRepository $userRepository,
        GroupRepository $groupRepository,
        PositionRepository $positionRepository,
        ParentChildRepository $parentChildRepository
    ) {
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->positionRepository = $positionRepository;
        $this->parentChildRepository = $parentChildRepository;
    }
    public function getUserById(int $userId): UserDTO
    {
        $userDTO= $this->userRepository->findUserById($userId);
        $userDTO->setTimeAtKipsu($this->convertDateToLength($userDTO->getTimeAtKipsu()));
        $userDTO->setSlackLink('https://kipsu.slack.com/team/' . $userDTO->getSlackLink());
        $groupId = $this->positionRepository->findGroupIdByPositionId($this->userRepository->findPositionIdByUserId($userDTO->getId()));
        $userDTO->setGroup($this->groupRepository->findGroupById($groupId));
        if($userDTO->getId() != 1) {
            $this->addSupervisor($userDTO);
        }
        if ($userDTO->isLead()) {
            $this->addReports($userDTO);
        }
        return $userDTO;
    }

    private function convertDateToLength(string $startDate): string
    {
        $startDate = strtotime($startDate);
        $secondsAtKipsu = time() - $startDate;
        $monthsAtKipsu = ceil($secondsAtKipsu / 30 / 24 / 60 / 60);
        $yearsAtKipsu = 0;
        while($monthsAtKipsu >= 12){
            $yearsAtKipsu++;
            $monthsAtKipsu -= 12;
        }

        if ($yearsAtKipsu > 1 && $monthsAtKipsu != 1) {
            return $yearsAtKipsu . ' years, ' . $monthsAtKipsu . ' months';
        } elseif ($yearsAtKipsu > 1 && $monthsAtKipsu == 1) {
            return $yearsAtKipsu . ' years, ' . $monthsAtKipsu . ' month';
        } elseif ($yearsAtKipsu === 1 && $monthsAtKipsu != 1) {
            return $yearsAtKipsu . ' year, ' . $monthsAtKipsu . ' months';
        } elseif ($yearsAtKipsu === 1 && $monthsAtKipsu == 1) {
            return $yearsAtKipsu . ' year, ' . $monthsAtKipsu . ' month';
        } elseif ($yearsAtKipsu === 0 && $monthsAtKipsu > 1) {
            return $monthsAtKipsu . ' months';
        } else {
            return '1 month';
        }
    }

    private function addSupervisor(UserDTO $userDTO): void
    {
        $groupId = $userDTO->getGroup()->getId();
        if ($userDTO->isLead()){
            $groupId = $this->parentChildRepository->findParentIdByChildId($userDTO->getGroup()->getId());
        }
        $groupLeadPositionId = $this->positionRepository->findGroupLeadPositionIdByGroupId($groupId);
        $groupLeadDTO = null;
        while(!$groupLeadDTO) {
            $groupLeadPositionId = $this->positionRepository->findGroupLeadPositionIdByGroupId($groupId);
            if($groupLeadPositionId){
                $groupLeadDTO = $this->userRepository->findUsersByPositionId($groupLeadPositionId);
            }
            $groupId = $this->parentChildRepository->findParentIdByChildId($groupId);
        }
        $userDTO->setSupervisor($this->userRepository->findUsersByPositionId($groupLeadPositionId)[0]);
    }

    private function addReports(UserDTO $userDTO)
    {
        $reportDTOs = array();
        $reportPositionIds = $this->positionRepository->findNonLeadPositionIdsByGroupId($userDTO->getGroup()->getId());
        if ($reportPositionIds) {
            $filteredReportPositionIds = array();
            foreach ($reportPositionIds as $reportPositionId) {
                $filteredReportPositionIds[] = $reportPositionId['id'];
            }
            foreach ($filteredReportPositionIds as $filteredReportPositionId){
                $positionDTOs = $this->userRepository->findUsersByPositionId($filteredReportPositionId);
                foreach ($positionDTOs as $positionDTO) {
                    array_push($reportDTOs, $positionDTO);
                }
            }
        }
        $childGroupIds = $this->parentChildRepository->findChildIdsByParentId($userDTO->getGroup()->getId());
        if ($childGroupIds) {
            $filteredChildGroupIds = array();
            foreach ($childGroupIds as $childGroupId){
                $filteredChildGroupIds[] = $childGroupId['1'];
            }
            foreach ($filteredChildGroupIds as $filteredChildGroupId){
                $groupLeadPositionId = $this->positionRepository->findGroupLeadPositionIdByGroupId($filteredChildGroupId);
                if ($groupLeadPositionId) {
                    $positionDTOs = $this->userRepository->findUsersByPositionId($groupLeadPositionId);
                    foreach ($positionDTOs as $positionDTO) {
                        array_push($reportDTOs, $positionDTO);
                    }
                } else {
                    $grandchildGroupIds = $this->parentChildRepository->findChildIdsByParentId($filteredChildGroupId);
                    if ($grandchildGroupIds) {
                        $filteredGrandchildGroupIds = array();
                        foreach ($grandchildGroupIds as $grandchildGroupId) {
                            $filteredGrandchildGroupIds[] = $grandchildGroupId['1'];
                        }
                        foreach ($filteredGrandchildGroupIds as $filteredGrandchildGroupId) {
                            $groupLeadPositionId = $this->positionRepository->findGroupLeadPositionIdByGroupId($filteredGrandchildGroupId);
                            if ($groupLeadPositionId) {
                                $positionDTOs = $this->userRepository->findUsersByPositionId($groupLeadPositionId);
                                foreach ($positionDTOs as $positionDTO) {
                                    array_push($reportDTOs, $positionDTO);
                                }
                            }

                        }
                    }
                }
            }
        }

        $userDTO->setReports($reportDTOs);
    }
}