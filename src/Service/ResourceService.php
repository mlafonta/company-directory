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
        GroupResourceRepository $groupResourceRepository
    ) {
        $this->resourceRepository = $resourceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->groupResourceRepository = $groupResourceRepository;
    }

    /**
     * @return ResourceDTO[]
     */
    public function getResourcesForGroup(int $id): array
    {
        $resourceIds = $this->groupResourceRepository->findResourceIdsByGroupId($id);
        $resourceDTOs[] = [];
        foreach ($resourceIds as $resourceId) {
            $resource = $this->resourceRepository->findById($resourceId);
            $this->categoryRepository->addCategory($resource);
            if (!in_array($resource, $resourceDTOs)) {
                array_push($resourceDTOs, $resource);
            }
        }
        return $resourceDTOs;
    }
}