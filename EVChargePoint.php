<?php

class EVChargePoint
{
  private $location;
  private $latitude;
  private $longitude;
  private $numberOfChargePorts;
  private $chargingSpeed;

  public function __construct($location, $latitude, $longitude, $numPorts, $speed)
  {
    $this->location = $location;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->numberOfChargePorts = $numPorts;
    $this->chargingSpeed = $speed;
  }

  public function getLocation()
  {
    return $this->location;
  }

  public function getLatitude()
  {
    return $this->latitude;
  }

  public function getLongitude()
  {
    return $this->longitude;
  }

  public function getNumberOfChargePorts()
  {
    return $this->numberOfChargePorts;
  }

  public function getChargingSpeed()
  {
    return $this->chargingSpeed;
  }
}
