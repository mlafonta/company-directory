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
    public function getAllResources(): array
    {
        $resources = $this->resourceRepository->getAllResources();
        foreach ($resources as $resource){
            $this->categoryRepository->addCategory($resource);
            $this->groupResourceRepository->addGroups($resource);
        }
        return $resources;
    }
}