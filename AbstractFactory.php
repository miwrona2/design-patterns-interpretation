<?php

interface Vehicle {
    public function getTotalWeight();
}

class Car implements Vehicle {

    private $weight;

    public function __construct(int $weight)
    {
        $this->weight = $weight;
    }

    public function getTotalWeight(): string
    {
        return (string)$this->weight . ' kg';
    }
}

class Truck implements Vehicle {
    private $weight;
    private $trailerWeight;

    public function __construct(int $weight, int $trailerWeight)
    {
        $this->weight = $weight;
        $this->trailerWeight = $trailerWeight;
    }

    public function getTotalWeight(): string
    {
        return (string)$this->sumWeight() . ' kg';
    }

    private function sumWeight(): int
    {
        return $this->weight + $this->trailerWeight;
    }
}

class CarFactory {

    const TRAIL_WEIGHT = 20000;

    public function createCar(int $weight): Vehicle
    {
        return new Car($weight);
    }

    public function createTruck($weight): Vehicle
    {
        return new Truck($weight, self::TRAIL_WEIGHT);
    }
}

class Usage {
    public function createVehicles()
    {
        $factory = new CarFactory();

        $car = $factory->createCar(1500);
        $carWeight = $car->getTotalWeight();

        $truck = $factory->createTruck(5000);
        $truckWeight = $truck->getTotalWeight();
    }
}
