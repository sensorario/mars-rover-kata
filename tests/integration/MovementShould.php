<?php

use Sensorario\MarsRover\Objects\Point;

class MovementShould extends PHPUnit\Framework\TestCase
{
    public function testReachValidPosition()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver($rover, $grid);

        $this->assertEquals([0,0], $receiver->roverDestination()->toArray());
        $receiver->read('ff');

        $this->assertEquals([0,2], $receiver->roverDestination()->toArray());
        $this->assertEquals([0,2], $receiver->roverPosition());
        $this->assertSame(false, $receiver->edgeDetected());
    }

    public function testDetectGridEdge()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(1, 1);
        $receiver = new Sensorario\MarsRover\Receiver($rover, $grid);

        $this->assertEquals([0,0], $receiver->roverDestination()->toArray());
        $receiver->read('f');
        $this->assertSame(true, $receiver->edgeDetected());
        $this->assertEquals([0,1], $receiver->roverDestination()->toArray());
    }

    public function testWrapNorwthEdge()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver($rover, $grid);

        $this->assertEquals([0,0], $receiver->roverDestination()->toArray());
        $receiver->read('ff');

        $this->assertEquals([0,2], $receiver->roverDestination()->toArray());
        $receiver->read('f');
        $this->assertEquals([0,3], $receiver->roverDestination()->toArray());
    }

    public function testWrapWestEdge()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver($rover, $grid);

        $this->assertEquals([0,0], $receiver->roverDestination()->toArray());
        $receiver->read('lf');
        $this->assertEquals([-1,0], $receiver->roverDestination()->toArray());
    }

    public function testWrapSouthEdge()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver($rover, $grid);

        $this->assertEquals([0,0], $receiver->roverDestination()->toArray());
        $receiver->read('rrf');
        $this->assertEquals([0,-1], $receiver->roverDestination()->toArray());
    }

    public function testWrapEastEdge()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver($rover, $grid);

        $this->assertEquals([0,0], $receiver->roverDestination()->toArray());
        $receiver->read('rff');
        $this->assertEquals([2,0], $receiver->roverDestination()->toArray());
        $receiver->read('f');
        $this->assertEquals([3,0], $receiver->roverDestination()->toArray());
        $this->assertEquals(4, $receiver->stepsMade());
    }

    public function testCompleteSequenceWheneverObstaclesAreNotPresent()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(3, 3);

        $planetFreeFromObstacles = new Sensorario\MarsRover\Receiver($rover, $grid);
        $planetFreeFromObstacles->read('rflfffff');
        $this->assertEquals([1,2], $planetFreeFromObstacles->roverDestination()->toArray());
        $this->assertEquals(8, $planetFreeFromObstacles->stepsMade());
    }

    public function testStopSequenceWheneverObstacleIsPresent()
    {
        $startigPoint = Sensorario\MarsRover\Objects\Point::origin();
        $rover = new Sensorario\MarsRover\Rover($startigPoint);
        $grid = new Sensorario\MarsRover\Grid(3, 3);

        $planetWithObstacles = new Sensorario\MarsRover\Receiver($rover, $grid);
        $planetWithObstacles->setObstacles([[1,1]]);
        $planetWithObstacles->read('rflfffff');
        $this->assertEquals([1,1], $planetWithObstacles->roverDestination()->toArray());
        $this->assertEquals(3, $planetWithObstacles->stepsMade());
    }
}
