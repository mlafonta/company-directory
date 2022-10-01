<?php

namespace App\Controller;

use App\Service\ResourceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResourceController extends AbstractController
{
    private ResourceService $resourceService;

    public function __construct(ResourceService $resourceService){
        $this->resourceService = $resourceService;
    }

    #[Route('/api/v1/groups/{id}/resources', methods: ['GET'])]
    public function listResourcesByGroup(int $id): Response
    {
        $resources = $this->resourceService->getResourcesForGroup($id);
        return $this->json($resources);
    }
}
