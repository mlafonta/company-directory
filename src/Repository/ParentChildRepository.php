<?php

namespace App\Repository;

use App\DTO\GroupDTO;
use App\Entity\ParentChild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ParentChild>
 *
 * @method ParentChild|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParentChild|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParentChild[]    findAll()
 * @method ParentChild[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParentChildRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParentChild::class);
    }

    public function add(ParentChild $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ParentChild $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findParentIdByChildId(int $id): int | null
    {
        $parentChild = $this->createQueryBuilder('p')
            ->andWhere('(p.child) = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if($parentChild){
            return $parentChild->getParent()->getId();
        } else {
            return null;
        }

    }

    public function findChildrenIdsByParentId(int $id): array
    {
        return $this->createQueryBuilder('p')
            ->select('(p.child)')
            ->andWhere('(p.parent) = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}