<?php

namespace App\Repository;

interface ILocationRepository{
  public function getLocation();
  public function getDeparment();
  public function createLocation(array $data);
  public function copyLocation($id);
  public function updateLocation($id ,array $data);
  public function editLocation($id);
  public function deleteLocation($id);
  public function finddeparment($id);
}
