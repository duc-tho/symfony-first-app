<?php

namespace App\Service;

use App\DTO\UserResponseDTO;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Exception;

class UserService extends BaseService
{
     private UserRepository $_userRepository;

     public function __construct(UserRepository $_userRepository)
     {
          $this->_userRepository = $_userRepository;
     }

     function getUsers()
     {
          $users = $this->_userRepository->findAll();
          $returnUsers = [];

          foreach ($users as $user) {
               $responseUser = new UserResponseDTO();

               $responseUser->id = $user->getId();
               $responseUser->Username = $user->getUsername();
               $responseUser->CreateAt = $user->getCreateAt();
               $responseUser->UpdateAt = $user->getUpdateAt();

               $returnUsers[] = $responseUser;
          }

          return $returnUsers;
     }

     public function getUser($id)
     {
          if (empty($id)) throw new Exception('User id is require');

          $user = $this->_userRepository->find($id);
          if (empty($user)) throw new Exception('User Not Found');

          $responseUser = new UserResponseDTO();

          $responseUser->id = $user->getId();
          $responseUser->Username = $user->getUsername();
          $responseUser->CreateAt = $user->getCreateAt();
          $responseUser->UpdateAt = $user->getUpdateAt();

          return $responseUser;
     }

     public function createUser($createUserData)
     {
          if (empty($createUserData->Username)) throw new Exception('Username is require');
          if (empty($createUserData->Password)) throw new Exception('Password is require');

          $newUser = new User();
          $newUser->setUsername($createUserData->Username);
          $newUser->setPassword(password_hash($createUserData->Password, PASSWORD_BCRYPT));
          $newUser->setCreateAt(new DateTimeImmutable());
          $newUser->setUpdateAt(new DateTimeImmutable());
          $createdUser = $this->_userRepository->create($newUser);

          $responseUser = new UserResponseDTO();
          $responseUser->id = $createdUser->getId();
          $responseUser->Username = $createdUser->getUsername();
          $responseUser->CreateAt = $createdUser->getCreateAt();
          $responseUser->UpdateAt = $createdUser->getUpdateAt();

          return $responseUser;
     }

     public function updateUser($id, $updateData)
     {
          if (empty($id)) throw new Exception('User id is require');
          if (empty($updateData) || !(array)$updateData) throw new Exception('Nothing to update');

          $user = $this->_userRepository->find($id);
          
          if (empty($user)) 
               throw new Exception('User Not Found');

          if (!empty($updateData->Username)) 
               $user->setUsername($updateData->Username);

          if (!empty($updateData->Password)) {
               $newHashPassword = password_hash($updateData->Password, PASSWORD_BCRYPT);
               $user->setPassword($newHashPassword);
          }

          $user->setUpdateAt(new DateTimeImmutable());

          $result = $this->_userRepository->update($user);

          $updateUser = new UserResponseDTO();
          $updateUser->id = $result->getId();
          $updateUser->Username = $result->getUsername();
          $updateUser->CreateAt = $result->getCreateAt();
          $updateUser->UpdateAt = $result->getUpdateAt();

          return $updateUser;
     }

     public function deleteUser($id) {
          if (empty($id)) throw new Exception('User id is require');

          $user = $this->_userRepository->find($id);
          if (empty($user)) throw new Exception('User Not Found');

          $this->_userRepository->delete($user);
     }
}
