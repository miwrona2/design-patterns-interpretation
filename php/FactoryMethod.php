<?php

namespace DesignPatterns\Creational\FactoryMethod;

interface ChocolateFactory
{
    public function makeChocolate();
}

class DarkChocolateFactory implements ChocolateFactory
{
    public function makeChocolate()
    {
        return new DarkChocolate();
    }
}

class MilkChocolateFactory implements ChocolateFactory
{
    public function makeChocolate()
    {
        return new MilkChocolate();
    }
}

interface Chocolate
{
    public function getType();
}

class DarkChocolate implements Chocolate
{
    public function getType()
    {
        return 'dark chocolate';
    }

}

class MilkChocolate implements Chocolate
{
    public function getType()
    {
        return 'milk chocolate';
    }
}

// usage
$milkChocolateFactory = new MilkChocolateFactory();
$mikChocolate = $milkChocolateFactory->makeChocolate();
print $mikChocolate->getType() . PHP_EOL;
// displays 'milk chocolate'

$darkChocolateFactory = new DarkChocolateFactory();
$darkChocolate = $darkChocolateFactory->makeChocolate();
print $darkChocolate->getType();
// displays 'dark chocolate'