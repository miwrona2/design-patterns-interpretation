<?php

interface Vehicle
{
    public function getTotalWeight(): int;
}

class Car implements Vehicle
{
    private $weight;

    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    public function getTotalWeight(): int
    {
        return $this->weight;
    }
}

interface Truck
{
    public function getTruckWeight(): int;

    public function getTrailerWeight(): int;
}

class HeavyDutyTruck implements Truck
{
    private $truckWeight;
    private $trailerWeight;

    public function setTruckWeight(int $truckWeight)
    {
        $this->truckWeight = $truckWeight;
    }

    public function setTrailerWeight(int $trailerWeight)
    {
        $this->trailerWeight = $trailerWeight;
    }

    public function getTruckWeight(): int
    {
        return $this->truckWeight;
    }

    public function getTrailerWeight(): int
    {
        return $this->trailerWeight;
    }
}

class HDTToCarAdapter implements Vehicle
{

    private $hdt;

    public function __construct(HeavyDutyTruck $hdt)
    {
        $this->hdt = $hdt;
    }

    public function getTotalWeight(): int
    {
        return $this->hdt->getTruckWeight() + $this->hdt->getTrailerWeight();
    }
}

// usage
class JohnDoesVehicles
{
    /** @var Vehicle[] */
    private $vehicles;

    public function addVehicle(Vehicle $vehicle)
    {
        $this->vehicles[] = $vehicle;
    }

    public function sumWeightOfAllVehicles()
    {
        $sumOfWeights = 0;
        foreach ($this->vehicles as $vehicle) {
            $sumOfWeights += $vehicle->getTotalWeight();
        }
        return $sumOfWeights;
    }
}

// John Doe wants to check if his garages floor is strong enough to hold all his vehicles
$johnDoesVehicles = new JohnDoesVehicles();
$fordMondeo = new Car();
$fordMondeo->setWeight(1200);
$johnDoesVehicles->addVehicle($fordMondeo);

$scania = new HeavyDutyTruck();
$scania->setTruckWeight(4000);
$scania->setTrailerWeight(10000);
$johnDoesVehicles->addVehicle(new HDTToCarAdapter($scania));

print_r($johnDoesVehicles->sumWeightOfAllVehicles());
// displays 15200