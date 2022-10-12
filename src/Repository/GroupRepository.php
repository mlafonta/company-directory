<?php

namespace App\Repository;

use App\DTO\GroupDTO;
use App\Entity\GroupData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupData>
 *
 * @method GroupData|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupData|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupData[]    findAll()
 * @method GroupData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupData::class);
    }

    public function findAllGroups(): array
    {
        $groupModels = $this->findAll();
        $groupDTOs = [];
        foreach ($groupModels as $groupModel) {
            $groupDTO = $this->convertModelToDTO($groupModel);
            array_push($groupDTOs, $groupDTO);
        }
        return $groupDTOs;
    }

    public function findGroupById($groupId): ?GroupDTO
    {
        $groupModel = $this->find($groupId);
        if ($groupModel) {
            return $this->convertModelToDTO($groupModel);
        } else {
            return null;
        }
    }

    private function convertModelToDTO(GroupData $groupModel): GroupDTO {
        $groupDTO = new GroupDTO();
        $groupDTO->setId($groupModel->getId());
        $groupDTO->setName($groupModel->getName());
        $groupDTO->setDescription(($groupModel->getDescription()));
        return $groupDTO;
    }


}
