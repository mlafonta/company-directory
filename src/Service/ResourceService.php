<?php

namespace App\Service;

use App\DTO\ResourceDTO;
use App\Repository\CategoryRepository;
use App\Repository\GroupResourceRepository;
use App\Repository\ResourceRepository;

class ResourceService
{
    private ResourceRepository $resourceRepository;
    private CategoryRepository $categoryRepository;
    private GroupResourceRepository $groupResourceRepository;

    public function __construct(
        ResourceRepository $resourceRepository,
        CategoryRepository $categoryRepository,
        GroupResourceRepository $groupResourceRepository,
    ) {
        $this->resourceRepository = $resourceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->groupResourceRepository = $groupResourceRepository;
    }

    public function getAllResources(): array
    {
        return $this->resourceRepository->findAllResources();
    }

    public function getResourcesByGroupId(int $groupId): array
    {
        $resourceIds = $this->groupResourceRepository->findResourceIdsByGroupId($groupId);
        $resourceDTOs[] = [];
        foreach ($resourceIds as $resourceId) {
            $resourceDTO = $this->resourceRepository->findResourceById($resourceId);
            if (!in_array($resourceDTO, $resourceDTOs)) {
                array_push($resourceDTOs, $resourceDTO);
            }
        }
        return $resourceDTOs;
    }

    public function addNewResourceToGroup(ResourceDTO $resourceDTO, int $groupId): void
    {
        $categoryId = $this->categoryRepository->findCategoryIdByName($resourceDTO->getCategory());
        $resourceId = $this->resourceRepository->addResource($resourceDTO, $categoryId)->getId();
        $this->groupResourceRepository->addResourceToGroup($resourceId, $groupId) ;
    }

    public function addExistingResourceToGroup(ResourceDTO $resource, int $groupId): void
    {
        $this->groupResourceRepository->addResourceToGroup($resource->getId(), $groupId);
    }

    public function updateResource(ResourceDTO $resourceDTO)
    {
        $categoryId = $this->categoryRepository->findCategoryIdByName($resourceDTO->getCategory());
        $this->resourceRepository->updateResource($resourceDTO, $categoryId);
    }

    public function deleteResourceFromGroup(int $groupId, int $resourceId)
    {
        $this->groupResourceRepository->deleteResourceFromGroup($groupId, $resourceId);
    }
}