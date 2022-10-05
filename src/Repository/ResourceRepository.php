<?php

namespace App\Repository;

use App\DTO\ResourceDTO;
use App\Entity\Category;
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

    public function findById(int $id): ?ResourceDTO
    {
        $resourceModel = $this->createQueryBuilder('r')
            ->andWhere('r.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult();

        return $this->convertToDTO($resourceModel);
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

    public function addResource(ResourceDTO $resourceDTO, int $categoryId): ResourceDTO
    {
        $resource = new Resource();
        $resource->setCategory($this->getEntityManager()->getReference(Category::class, $categoryId));
        $resource->setName($resourceDTO->getName());
        $resource->setDescription($resourceDTO->getDescription());
        $resource->setUrl($resourceDTO->getUrl());
        $resource->setActive(true);

        $this->getEntityManager()->persist($resource);
        $this->getEntityManager()->flush();
        $resourceDTO->setId($resource->getId());
        return $resourceDTO;
    }

    public function getAllResources()
    {
        $resourceModel = $this->createQueryBuilder('r')
            ->getQuery()
            ->getResult();
        $resourceDTOs = [];
        foreach ($resourceModel as $resource) {
            $resourceDTO = $this->convertToDTO($resource);
            array_push($resourceDTOs, $resourceDTO);
        }

        return $resourceDTOs;
    }

    public function updateResource(ResourceDTO $resource, int $categoryId)
    {
        $resourceModel = $this->createQueryBuilder('r')
            ->andWhere('r.id = :val')
            ->setParameter('val', $resource->getId())
            ->getQuery()
            ->getOneOrNullResult();

        $resourceModel->setCategory($this->getEntityManager()->getReference(Category::class, $categoryId));
        $resourceModel->setName($resource->getName());
        $resourceModel->setDescription($resource->getDescription());
        $resourceModel->setUrl($resource->getUrl());
        $resourceModel->setActive(true);
        $this->getEntityManager()->persist($resourceModel);
        $this->getEntityManager()->flush();
    }

}
