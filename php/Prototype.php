<?php

namespace DesignPatterns\Creational\Prototype;

abstract class VehiclePrototype
{
    /**
     * @var string
     */
    protected $brand;

    protected $vehicleType;

    abstract protected function __clone();


    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getVehicleType(): string
    {
        return $this->vehicleType;
    }

}

class Truck extends VehiclePrototype
{

    protected $vehicleType = 'Truck';

    public function __clone()
    {
    }
}

class SUV extends VehiclePrototype
{

    protected $vehicleType = 'SUV';

    public function __clone()
    {
    }
}

// usage
$truck = new Truck();

$iveco = clone $truck;
$iveco->setBrand('Iveco');
var_dump($iveco->getBrand());
// string(5) "Iveco"
var_dump($iveco->getVehicleType());
// string(5) "Truck"

$daf = clone $truck;
$daf->setBrand('Daf');
var_dump($daf->getBrand());
// string(3) "Daf"
var_dump($daf->getVehicleType());
// string(5) "Truck"

$suv = new SUV();

$mazda = clone $suv;
$mazda->setBrand('Mazda');
var_dump($mazda->getBrand());
// string(5) "Mazda"
var_dump($mazda->getVehicleType());
// string(3) "SUV"

$honda = clone $suv;
$honda->setBrand('Honda');
var_dump($honda->getBrand());
// string(5) "Honda"
var_dump($honda->getVehicleType());
// string(3) "SUV"