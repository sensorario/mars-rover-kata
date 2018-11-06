<?php

use Sensorario\MarsRover\Objects\Point;

class MovementShould extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->startigPoint = Point::origin();
        $this->rover = new Sensorario\MarsRover\Rover($this->startigPoint);
        $this->predictor = new Sensorario\MarsRover\Receiver\Predictor();
    }

    public function testReachValidPosition()
    {
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $this->assertEquals([0,0], $receiver->rover()->destination()->toArray());
        $receiver->read('ff');

        $this->assertEquals([0,2], $receiver->rover()->position());
        $this->assertSame(false, $receiver->edgeDetected());
    }

    public function testDetectGridEdge()
    {
        $grid = new Sensorario\MarsRover\Grid(1, 1);

        $receiver = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $this->assertEquals([0,0], $receiver->rover()->destination()->toArray());
        $receiver->read('f');
        $this->assertSame(true, $receiver->edgeDetected());
        $this->assertEquals([0,0], $receiver->rover()->position());
    }

    public function testWrapNorwthEdge()
    {
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $this->assertEquals([0,0], $receiver->rover()->destination()->toArray());
        $receiver->read('ff');

        $this->assertEquals([0,2], $receiver->rover()->position());
        $receiver->read('f');
        $this->assertEquals([0,0], $receiver->rover()->position());
    }

    public function testWrapWestEdge()
    {
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $this->assertEquals([0,0], $receiver->rover()->position());
        $receiver->read('lf');
        $this->assertEquals([2,0], $receiver->rover()->position());
    }

    public function testWrapSouthEdge()
    {
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $this->assertEquals([0,0], $receiver->rover()->position());
        $receiver->read('rrf');
        $this->assertEquals([0,2], $receiver->rover()->position());
    }

    public function testWrapEastEdge()
    {
        $grid = new Sensorario\MarsRover\Grid(3, 3);
        $receiver = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $this->assertEquals([0,0], $receiver->rover()->position());
        $receiver->read('rff');
        $this->assertEquals([2,0], $receiver->rover()->position());
        $receiver->read('f');
        $this->assertEquals([0,0], $receiver->rover()->position());
        $this->assertEquals(4, $receiver->stepsMade());
    }

    public function testCompleteSequenceWheneverObstaclesAreNotPresent()
    {
        $grid = new Sensorario\MarsRover\Grid(3, 3);

        $planetFreeFromObstacles = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $planetFreeFromObstacles->read('rflfffff');

        $this->assertEquals([1,2], $planetFreeFromObstacles->rover()->position());
        $this->assertEquals(8, $planetFreeFromObstacles->stepsMade());
    }

    public function testStopSequenceWheneverObstacleIsPresent()
    {
        $grid = new Sensorario\MarsRover\Grid(3, 3);

        $planetWithObstacles = new Sensorario\MarsRover\Receiver\Receiver(
            $this->predictor,
            $this->rover,
            $grid
        );

        $planetWithObstacles->setObstacles([[1,1]]);
        $planetWithObstacles->read('rflfffff');
        $this->assertEquals([1,0], $planetWithObstacles->rover()->position());
        $this->assertEquals(3, $planetWithObstacles->stepsMade());
    }
}
