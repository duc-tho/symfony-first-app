<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class BaseRepository extends ServiceEntityRepository
{
     private $_entity;
     private ManagerRegistry $_registry;

     public function __construct(ManagerRegistry $registry, $entity)
     {
          $this->_entity = $entity;
          $this->_registry = $registry;
          parent::__construct($registry, $entity);
     }

     public function create($entity)
     {
          $this->getEntityManager()->persist($entity);
          $this->getEntityManager()->flush();

          return $entity;
     }

     public function update($entity)
     {
          $this->getEntityManager()->persist($entity);
          $this->getEntityManager()->flush();

          return $entity;
     }

     public function delete($entity): void
     {
          $this->getEntityManager()->remove($entity);
          $this->getEntityManager()->flush();
     }
}
