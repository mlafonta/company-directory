<?php

namespace App\Repository;

use App\DTO\ResourceDTO;
use App\Entity\Resource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resource>
 *
 * @method Resource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resource[]    findAll()
 * @method Resource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resource::class);
    }

    public function add(Resource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Resource $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return IResource[] Returns an array of IResource objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IResource
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     * @return ResourceDTO[]
     */
    public function getAllResources(): array
    {
        $resourceModels = $this->findAll();
        $resourceDTOs = [];
        foreach ($resourceModels as $model) {
            $resourceDTO = $this->convertToDTO($model);
            array_push($resourceDTOs, $resourceDTO);
        }
        return $resourceDTOs;
    }

    private function convertToDTO(Resource $model): ResourceDTO
    {
        $resourceDTO = new ResourceDTO();
        $resourceDTO->setId($model->getId());
        $resourceDTO->setName($model->getName());
        $resourceDTO->setCategory(strval($model->getCategory()->getId()));
        $resourceDTO->setDescription($model->getDescription());
        $resourceDTO->setUrl($model->getUrl());
        $resourceDTO->setActive($model->isActive());

        return $resourceDTO;
    }
}
