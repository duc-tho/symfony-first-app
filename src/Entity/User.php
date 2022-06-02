<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User //extends BaseEntity
{
     /**
      * @ORM\id
      * @ORM\GeneratedValue
      * @ORM\Column(type="integer")
      */
     private $id;

     /**
      * @ORM\Column(type="string", length=50)
      */
     private $Username;

     /**
      * @ORM\Column(type="string", length=255)
      */
     private $Password;

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

     public function getUsername(): ?string
     {
          return $this->Username;
     }

     public function setUsername(string $Username): self
     {
          $this->Username = $Username;

          return $this;
     }

     public function getPassword(): ?string
     {
          return $this->Password;
     }

     public function setPassword(string $Password): self
     {
          $this->Password = $Password;

          return $this;
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
