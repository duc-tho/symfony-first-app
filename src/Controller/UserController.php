<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
     private UserService $_userService;

     public function __construct(UserService $userService)
     {
          $this->_userService = $userService;
     }

     function index(): JsonResponse
     {
          $result = $this->_userService->getUsers();

          return $this->json($result, 200);
     }

     public function getById(Request $request)
     {
          $userId = $request->attributes->get('id');

          $result = $this->_userService->getUser($userId);

          return $this->json($result);
     }

     function create(Request $request): JsonResponse
     {
          $createUserData = json_decode($request->getContent());

          $newUser = $this->_userService->createUser($createUserData);

          return $this->json($newUser);
     }

     function update(Request $request): JsonResponse
     {
          $userId = $request->attributes->get('id');
          $newUserData = json_decode($request->getContent());

          $result = $this->_userService->updateUser($userId, $newUserData);

          return $this->json($result,200);
     }

     function delete(Request $request)
     {
          $userId = $request->attributes->get('id');
          $this->_userService->deleteUser($userId);

          return new Response('Delete user with id '. $userId .' successfully');
     }
}
