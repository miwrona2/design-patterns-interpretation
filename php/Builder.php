<?php

namespace DesignPatterns\Creational\Builder;

interface Builder
{

    public function createBuilding();

    public function buildFoundations();

    public function constructWalls();

    public function roofBuilding();

    public function getBuilding();
}

class DetachedHouseBuilder implements Builder
{

    /** @var DetachedHouse */
    private $detachedHouse;

    public function createBuilding()
    {
        $this->detachedHouse = new DetachedHouse();
    }

    public function buildFoundations()
    {
        $this->detachedHouse->finishStageOfBuilding('eastFooting', new WallFooting());
        $this->detachedHouse->finishStageOfBuilding('northFooting', new WallFooting());
        $this->detachedHouse->finishStageOfBuilding('westFooting', new WallFooting());
        $this->detachedHouse->finishStageOfBuilding('southFooting', new WallFooting());
        $this->detachedHouse->finishStageOfBuilding('inMiddleFooting', new WallFooting());
    }

    public function constructWalls()
    {
        $this->detachedHouse->finishStageOfBuilding('firstFloor', new Walls());
        $this->detachedHouse->finishStageOfBuilding('secondFloor', new Walls());
    }

    public function roofBuilding()
    {
        $this->detachedHouse->finishStageOfBuilding('eastSlope', new RoofSlope());
        $this->detachedHouse->finishStageOfBuilding('northSlope', new RoofSlope());
        $this->detachedHouse->finishStageOfBuilding('westSlope', new RoofSlope());
        $this->detachedHouse->finishStageOfBuilding('southSlope', new RoofSlope());
    }

    public function getBuilding(): Building
    {
        return $this->detachedHouse;
    }
}

class BlockOfFlatsBuilder implements Builder
{

    /** @var BlockOfFlats */
    private $blockOfFlats;

    public function createBuilding()
    {
        $this->blockOfFlats = new BlockOfFlats();
    }

    public function buildFoundations()
    {
        $this->blockOfFlats->finishStageOfBuilding('eastFooting', new WallFooting());
        $this->blockOfFlats->finishStageOfBuilding('northFooting', new WallFooting());
        $this->blockOfFlats->finishStageOfBuilding('westFooting', new WallFooting());
        $this->blockOfFlats->finishStageOfBuilding('southFooting', new WallFooting());
        $this->blockOfFlats->finishStageOfBuilding('oneInMiddleFooting', new WallFooting());
        $this->blockOfFlats->finishStageOfBuilding('secondInMiddleFooting', new WallFooting());
    }

    public function constructWalls()
    {
        $this->blockOfFlats->finishStageOfBuilding('firstFloor', new Walls());
        $this->blockOfFlats->finishStageOfBuilding('secondFloor', new Walls());
        $this->blockOfFlats->finishStageOfBuilding('thirdFloor', new Walls());
        $this->blockOfFlats->finishStageOfBuilding('fourthFloor', new Walls());
        $this->blockOfFlats->finishStageOfBuilding('fifthFloor', new Walls());
    }

    public function roofBuilding()
    {
        $this->blockOfFlats->finishStageOfBuilding('oneFlatSlope', new RoofSlope());
    }

    public function getBuilding(): Building
    {
        return $this->blockOfFlats;
    }
}

abstract class Building
{

    private $buildingParts = [];

    public function finishStageOfBuilding($key, $value)
    {
        $this->buildingParts[$key] = $value;
    }
}

class DetachedHouse extends Building
{
}

class BlockOfFlats extends Building
{
}

class Walls
{
}

class WallFooting
{
}

class RoofSlope
{
}
