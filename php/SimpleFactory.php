<?php
class SimpleFactory {
    public function createCar(){
        return new Car();
    }
}

class Car {

    public function getName(string $name): string
    {
        return 'Car name is: ' . $name;
    }
}

class Usage {
    public function createCarInFactory()
    {
        $factory = new SimpleFactory();
        $car = $factory->createCar();
        $car->getName('Volvo');
    }
}