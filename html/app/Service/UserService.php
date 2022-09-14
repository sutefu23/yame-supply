<?php

  namespace App\Service;

  use App\Http\DataModel\UserPostData;
  use App\Models\User;

  class UserService {
      public function create(UserPostData $data){
        User::create(
            (array)$data
        );
      }
      public function update(){

      }
      public function read(){

      }

      public function readQuery(){

      }

      public function delete(){

      }
  }
