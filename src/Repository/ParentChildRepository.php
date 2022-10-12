<?php

namespace App\Repository;

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

    public function findChildIdsByParentId(int $parentId): array
    {
        return $this->createQueryBuilder('p')
            ->select('(p.child)')
            ->andWhere('(p.parent) = :id')
            ->setParameter('id', $parentId)
            ->getQuery()
            ->getResult();
    }

    public function findParentIdByChildId(int $childId): int | null
    {
        $parentChildModel = $this->findOneBy(array('child' => $childId));
        if($parentChildModel){
            return $parentChildModel->getParent()->getId();
        } else {
            return null;
        }

    }
}