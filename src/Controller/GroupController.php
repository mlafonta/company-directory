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
    public function listGroups(): JsonResponse {

        $groups = $this->groupService->getAllGroups();
        return $this->json($groups);

    }

    #[Route('/api/v1/groups/{id}', methods: ['GET'])]
    public function getGroupById(int $id): JsonResponse {

        $group = $this->groupService->getGroupById($id);
        if (!$group) {
            throw $this->createNotFoundException('Group not found');
        }

        return $this->json($group);

    }
}
