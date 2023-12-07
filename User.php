<?php

class User
{
  private $currentLocation;

  public function setCurrentLocation($location)
  {
    $this->currentLocation = $location;
  }

  public function findNearestChargePoint($chargingPoints)
  {
    $nearestPoint = null;
    $minDistance = PHP_FLOAT_MAX;

    foreach ($chargingPoints as $point) {
      $distance = $this->calculateDistance($this->currentLocation, $point->getLocation());

      if ($distance < $minDistance) {
        $nearestPoint = $point;
        $minDistance = $distance;
      }
    }

    return $nearestPoint;
  }

  private function calculateDistance($location1, $location2)
  {

    return rand(1, 100);
  }
}
