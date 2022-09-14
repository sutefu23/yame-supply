<?php

  namespace App\Http\DataModel{
      class UserData {
          public int $id;
          public string $name;
          public string $category;
      }
      class UserDeleteData {
          public int $id;
      }
      class UserPostData {
          public string $name;
          public string $category;
          public string $email;
      }
      class UserUpdateData {
          public int $id;
          public ?string $name;
          public ?string $category;
      }
  }
