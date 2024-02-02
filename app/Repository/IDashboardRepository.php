<?php

namespace App\Repository;

interface IDashboardRepository{
  public function getUser();
  public function getAsset();
  public function countAsset();
  public function countUser();
}
