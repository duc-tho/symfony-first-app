<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class BaseEntity
{
     /**
      * @ORM\id
      * @ORM\GeneratedValue
      * @ORM\Column(type="integer")
      */
     private $id;

     /**
      * @ORM\Column(type="datetime")
      */
     private $CreateAt;

     /**
      * @ORM\Column(type="datetime_immutable")
      */
     private $UpdateAt;

     public function getId(): ?int
     {
          return $this->id;
     }

     public function getCreateAt(): ?\DateTimeInterface
     {
          return $this->CreateAt;
     }

     public function setCreateAt(\DateTimeInterface $CreateAt): self
     {
          $this->CreateAt = $CreateAt;

          return $this;
     }

     public function getUpdateAt(): ?\DateTimeImmutable
     {
          return $this->UpdateAt;
     }

     public function setUpdateAt(\DateTimeImmutable $UpdateAt): self
     {
          $this->UpdateAt = $UpdateAt;

          return $this;
     }
}
