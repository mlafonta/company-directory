<?php

namespace App\Repository;

use App\Entity\Position;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Position>
 *
 * @method Position|null find($id, $lockMode = null, $lockVersion = null)
 * @method Position|null findOneBy(array $criteria, array $orderBy = null)
 * @method Position[]    findAll()
 * @method Position[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Position::class);
    }

    public function findPositionIdsByGroupId(int $groupId): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id')
            ->andWhere('(p.group_data) = :id')
            ->setParameter('id', $groupId)
            ->getQuery()
            ->getResult();
    }

    public function findGroupIdByPositionId(int $positionId): int
    {
        return $this->createQueryBuilder('p')
            ->select('(p.group_data)')
            ->andWhere('p.id = :id')
            ->setParameter('id', $positionId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findGroupLeadPositionIdByGroupId(?int $groupId)
    {
        $groupLeadPositionId = $this->createQueryBuilder('p')
            ->select('p.id')
            ->andWhere('(p.group_data) = :id')
            ->andWhere('p.is_lead = true')
            ->setParameter('id', $groupId)
            ->getQuery()
            ->getOneOrNullResult();

        if ($groupLeadPositionId) {
            return $groupLeadPositionId['id'];
        } else {
            return null;
        }
    }

    public function findNonLeadPositionIdsByGroupId(int $groupId): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id')
            ->andWhere('(p.group_data) = :id')
            ->andWhere('p.is_lead = false')
            ->setParameter('id', $groupId)
            ->getQuery()
            ->getResult();
    }
}
