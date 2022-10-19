<?php

namespace App\Controller;

use App\DTO\ResourceDTO;
use App\Service\ResourceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/api/v1/resources', methods: ['GET'])]
    public function getAllResources(): JsonResponse
    {
        $resourceDTOS = $this->resourceService->getAllResources();
        return $this->json($resourceDTOS);
    }

    #[Route('/api/v1/groups/{groupId}/resources', methods: ['GET'])]
    public function getResourcesByGroupId(int $groupId): JsonResponse
    {
        $resourceDTOS = $this->resourceService->getResourcesByGroupId($groupId);
        return $this->json($resourceDTOS);
    }

    #[Route('/api/v1/groups/{groupId}/resources', methods: ['POST'])]
    public function addResourceToGroup(Request $request, int $groupId): Response
    {
        $resourceDTO = $this->ConvertRequestToDTO($request);
        if ($resourceDTO->getId() > 0) {
            $this->resourceService->addExistingResourceToGroup($resourceDTO, $groupId);
        } else {
            $this->resourceService->addNewResourceToGroup($resourceDTO, $groupId);
        }
        return new Response();
    }

    #[Route('/api/v1/resources/{id}', methods: ['PUT'])]
    public function updateResource(Request $request): Response
    {
        $resourceDTO = $this->ConvertRequestToDTO($request);
        $this->resourceService->updateResource($resourceDTO);
        return new Response();
    }

    #[Route('/api/v1/groups/{groupId}/resources/{resourceId}', methods: ['DELETE'])]
    public function removeResourceFromGroup(int $groupId, int $resourceId): Response
    {
        $this->resourceService->deleteResourceFromGroup($groupId, $resourceId);
        return new Response();
    }

    private function ConvertRequestToDTO(Request $request): ResourceDTO
    {
        $resourceDTO = new ResourceDTO();
        $resourceDTO->setId($request->get('id'));
        $resourceDTO->setName($request->get('name'));
        $resourceDTO->setCategory(($request->get('category')));
        $resourceDTO->setDescription($request->get('description'));
        $resourceDTO->setUrl($request->get('url'));
        $resourceDTO->setActive(true);
        return $resourceDTO;
    }
}
