<?php

namespace DesignPatterns\Other\SimpleFactory;

class SimpleFactory
{
    public function createCar()
    {
        return new Car();
    }
}

class Car
{
    public function getName(string $name): string
    {
        return 'Car name is: ' . $name;
    }
}

// usage
$factory = new SimpleFactory();
$car = $factory->createCar();
print $car->getName('Volvo');
// displays 'Car name is: Volvo'