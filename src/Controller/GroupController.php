<?php

namespace App\Controller;

use App\Service\GroupService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService){
        $this->groupService = $groupService;
    }


    public function test(): Response {
        $test = [['{"id": 1, "name": "Engineering", "description": "string", "type": "department", "parent": 8, "children": []}'], ['{"id": 2, "name": "Squad K", "description": "string", "type": "team", "parent": 8, "children": []}']];
        return $this->json($test);
    }

    #[Route('/api/v1/groups')]
    public function listGroups(Request $request): Response {

        $groups = $this->groupService->getAllGroups();
        return $this->json($groups);
    }
}
