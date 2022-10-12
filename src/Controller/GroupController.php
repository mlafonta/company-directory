<?php
namespace App\Controller;

use App\Service\GroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService){
        $this->groupService = $groupService;
    }


    #[Route('/api/v1/groups', methods: ['GET'])]
    public function getAllGroups(): JsonResponse {
        $groupDTOs = $this->groupService->getAllGroups();
        return $this->json($groupDTOs);
    }

    #[Route('/api/v1/groups/{groupId}', methods: ['GET'])]
    public function getGroupById(int $groupId): JsonResponse {
        $groupDTO = $this->groupService->getGroupById($groupId);
        return $this->json($groupDTO);
    }
}
