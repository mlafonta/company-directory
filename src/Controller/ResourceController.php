<?php

namespace App\Controller;

use App\DTO\ResourceDTO;
use App\Service\ResourceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResourceController extends AbstractController
{
    private ResourceService $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    #[Route('/api/v1/groups/{id}/resources', methods: ['GET'])]
    public function listResourcesByGroup(int $id): Response
    {
        $resources = $this->resourceService->getResourcesForGroup($id);
        return $this->json($resources);
    }

    #[Route('/api/v1/resources', methods: ['GET'])]
    public function listResources(): Response
    {
        $resources = $this->resourceService->getAllResources();
        return $this->json($resources);
    }

    #[Route('/api/v1/groups/{groupId}/resources', methods: ['POST'])]
    public function addResourceToGroup(Request $request, int $groupId): Response
    {
        $resource = $this->ConvertToDTO($request);

        if ($resource->getId() > 0) {
            $this->resourceService->addExistingResourceToGroup($resource, $groupId);
        } else {
            $this->resourceService->addNewResourceToGroup($resource, $groupId);
        }
        return new Response();
    }

    #[Route('/api/v1/resources/{id}', methods: ['PUT'])]
    public function UpdateResource(Request $request): Response
    {
        $resource = $this->ConvertToDTO($request);
        $this->resourceService->updateResource($resource);
        return new Response();

    }

    #[Route('/api/v1/groups/{groupId}/resources/{resourceId}', methods: ['DELETE'])]
    public function RemoveResourceFromGroup(int $groupId, int $resourceId)
    {
        $this->resourceService->deleteResourceFromGroup($groupId, $resourceId);

    }

    /**
     * @param Request $request
     * @return void
     */
    public function ConvertToDTO(Request $request): ResourceDTO
    {
        $resource = new ResourceDTO();
        $resource->setId($request->get('id'));
        $resource->setName($request->get('name'));
        $resource->setCategory(($request->get('category')));
        $resource->setDescription($request->get('description'));
        $resource->setUrl($request->get('url'));
        $resource->setActive(true);
        return $resource;
    }
}
