<?php

namespace App\Repository;

use App\DTO\ResourceDTO;
use App\Entity\GroupResource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupResource>
 *
 * @method GroupResource|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupResource|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupResource[]    findAll()
 * @method GroupResource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupResource::class);
    }

    public function add(GroupResource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GroupResource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GroupResource[] Returns an array of GroupResource objects
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

//    public function findOneBySomeField($value): ?GroupResource
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function addGroups(ResourceDTO $resource): void
    {
        $groupArray = $this->findGroupIdsByResourceId($resource->getId());
        $simpleGroupArray= array();
        foreach ($groupArray as $group) {
            $simpleGroupArray[] = $group['1'];
        }
        $resource->setGroups($simpleGroupArray);
    }

    private function findGroupIdsByResourceId(int $id): array
    {
        return $this->createQueryBuilder('g')
            ->select('(g.group_data)')
            ->andWhere('(g.resource) = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getScalarResult()
        ;
    }
}
