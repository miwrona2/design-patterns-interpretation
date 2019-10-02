<?php

interface ChocolateFactory
{
    public function makeChocolate();
}

interface Chocolate
{
    public function getType();
}

class DarkChocolateFactory implements ChocolateFactory
{
    public function makeChocolate()
    {
        return new DarkChocolate();
    }
}

class DarkChocolate implements Chocolate
{
    public function getType()
    {
        return 'Dark chocolate';
    }
}

// usage
$factory = new DarkChocolateFactory();
$chocolate = $factory->makeChocolate();
print $chocolate->getType();
// displays 'Dark chocolate'