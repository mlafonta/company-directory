<?php

namespace App\Service;

use App\DTO\ResourceDTO;
use App\Repository\CategoryRepository;
use App\Repository\GroupRepository;
use App\Repository\GroupResourceRepository;
use App\Repository\ResourceRepository;

class ResourceService
{
    private ResourceRepository $resourceRepository;
    private CategoryRepository $categoryRepository;
    private GroupResourceRepository $groupResourceRepository;
    private GroupRepository $groupRepository;

    public function __construct(
        ResourceRepository $resourceRepository,
        CategoryRepository $categoryRepository,
        GroupResourceRepository $groupResourceRepository,
        GroupRepository $groupRepository
    ) {
        $this->resourceRepository = $resourceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->groupResourceRepository = $groupResourceRepository;
        $this->groupRepository = $groupRepository;
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

    public function addNewResourceToGroup(ResourceDTO $resource, int $groupId): void
    {
        $this->groupResourceRepository->addResourceToGroup($this->resourceRepository->addResource($resource, $this->categoryRepository->getIdByCategory($resource->getCategory()))->getId(),$this->groupRepository->getOneById($groupId)->getId()) ;
    }

    public function addExistingResourceToGroup(ResourceDTO $resource, int $groupId): void
    {
        $this->groupResourceRepository->addResourceToGroup($resource->getId(), $groupId);
    }


    /**
     * @return ResourceDTO[]
     */
    public function getAllResources(): array
    {
        $resources = $this->resourceRepository->getAllResources();
        foreach ($resources as $resource) {
            $this->categoryRepository->addCategory($resource);
        }
        return $resources;
    }

    public function updateResource(ResourceDTO $resource)
    {
        $this->resourceRepository->updateResource($resource, $this->categoryRepository->getIdByCategory($resource->getCategory()));
    }

    public function deleteResourceFromGroup(int $groupId, int $resourceId)
    {
        $this->groupResourceRepository->deleteResourceFromGroup($groupId, $resourceId);
    }
}