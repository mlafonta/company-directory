<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    #[Route('/api/v1/users', methods: ['GET'])]
    public function getAllUsers(): JsonResponse
    {
        $userDTOs = $this->userService->getAllUsers();
        return $this->json($userDTOs);
    }

    #[Route('/api/v1/users/{userId}', methods: ['GET'])]
    public function getUserById(int $userId): JsonResponse
    {
        $userDTO = $this->userService->getUserById($userId);
        return $this->json($userDTO);
    }
}
