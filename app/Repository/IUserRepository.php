<?php

namespace App\Repository;

interface IUserRepository{
   public function getUser();
   public function getLocation();
   public function getRole();
   public function findUser($id);
   public function changePass($id ,array $data);
}
