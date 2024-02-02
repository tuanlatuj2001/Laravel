<?php

namespace App\Repository;

interface IAssetRepository{
  public function getAsset();
  public function generate($id);
  public function findAsset($id);
  public function createAsset(array $data);
  public function getCategorie();
  public function getLocation();
  public function getManufacturer();
  public function getSupplier();
  public function getAllAsset();
  public function updateAsset($id ,array $data);
  public function editAsset($id);
  public function deleteLocation($id);
}
