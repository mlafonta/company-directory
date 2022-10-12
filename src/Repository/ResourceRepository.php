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

    public function findAllResources(): array
    {
        $resourceModels = $this->findAll();
        $resourceDTOs = [];
        foreach ($resourceModels as $resourceModel) {
            $resourceDTO = $this->convertModelToDTO($resourceModel);
            array_push($resourceDTOs, $resourceDTO);
        }
        return $resourceDTOs;
    }

    public function findResourceById(int $resourceId): ?ResourceDTO
    {
        $resourceModel = $this->find($resourceId);
        return $this->convertModelToDTO($resourceModel);
    }

    public function addResource(ResourceDTO $resourceDTO, int $categoryId): ResourceDTO
    {
        $resourceModel = new Resource();
        $this->convertDTOToModel($resourceModel, $categoryId, $resourceDTO);
        $this->commitToDatabase($resourceModel);
        $resourceDTO->setId($resourceModel->getId());
        return $resourceDTO;
    }

    public function updateResource(ResourceDTO $resourceDTO, int $categoryId)
    {
        $resourceModel = $this->find($resourceDTO->getId());
        $this->convertDTOToModel($resourceModel, $categoryId, $resourceDTO);
        $this->commitToDatabase($resourceModel);
    }

    private function commitToDatabase(?Resource $resourceModel): void
    {
        $this->getEntityManager()->persist($resourceModel);
        $this->getEntityManager()->flush();
    }

    private function convertModelToDTO(Resource $resourceModel): ResourceDTO
    {
        $resourceDTO = new ResourceDTO();
        $resourceDTO->setId($resourceModel->getId());
        $resourceDTO->setName($resourceModel->getName());
        $resourceDTO->setCategory($this->getEntityManager()->getReference(Category::class, $resourceModel->getCategory()->getId())->getCategory());
        $resourceDTO->setDescription($resourceModel->getDescription());
        $resourceDTO->setUrl($resourceModel->getUrl());
        $resourceDTO->setActive($resourceModel->isActive());
        return $resourceDTO;
    }

    private function convertDTOToModel(Resource $resourceModel, int $categoryId, ResourceDTO $resourceDTO): void
    {
        $resourceModel->setCategory($this->getEntityManager()->getReference(Category::class, $categoryId));
        $resourceModel->setName($resourceDTO->getName());
        $resourceModel->setDescription($resourceDTO->getDescription());
        $resourceModel->setUrl($resourceDTO->getUrl());
        $resourceModel->setActive(true);
    }

}
