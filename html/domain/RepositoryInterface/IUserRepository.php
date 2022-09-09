<?php
  namespace Domain\RepositoryInterface;
  use Domain\Entity\UserEntity;
  interface IUserRepository {
      public function save(UserEntity $userData):UserEntity;
      public function get_by_id(int $userId):UserEntity;
      public function update(UserEntity $userData):UserEntity;
      public function delete(int $userId):UserEntity;
  }
