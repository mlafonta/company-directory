<?php
namespace App\Controller;

use App\Service\GroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService){
        $this->groupService = $groupService;
    }


    #[Route('/api/v1/groups', methods: ['GET'])]
    public function listGroups(Request $request): JsonResponse {

        $groups = $this->groupService->getAllGroups();
        return $this->json($groups);

    }
}
