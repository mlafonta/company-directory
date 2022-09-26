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

    public function add(GroupData $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GroupData $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GroupData[] Returns an array of GroupData objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function getOneById($id): ?GroupDTO
    {
        $model = $this->createQueryBuilder('g')
            ->andWhere('g.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if ($model) {
            return $this->convertToDTO($model);
        } else {
            return null;
        }
    }

    /**
     * @return GroupDTO[]
     */
    public function getAllGroups(): array
    {
        $groupModels = $this->findAll();
        $groupDTOs = [];
        foreach ($groupModels as $model ) {
            $groupDTO = $this->convertToDTO($model);
            array_push($groupDTOs, $groupDTO);
        }
        return $groupDTOs;
    }

    private function convertToDTO(GroupData $model): GroupDTO {
        $groupDTO = new GroupDTO();
        $groupDTO->setId($model->getId());
        $groupDTO->setName($model->getName());
        $groupDTO->setDescription(($model->getDescription()));

        return $groupDTO;
    }

    public function findIdbyPositionId(int $id)
    {
    }


}
