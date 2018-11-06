<?php

namespace Sensorario\MarsRover;

use PHPUnit\Framework\TestCase;
use Sensorario\MarsRover\Objects\Point;
use Sensorario\MarsRover\Rover;

class RoverShould extends TestCase
{
    public function setUp()
    {
        $this->rover = new Rover(
            Point::origin()
        );
    }

    public function testStartFromCenterOfTheWorld()
    {
        $this->assertEquals([0, 0], $this->rover->position());
    }

    public function testPointToNorthByDefault()
    {
        $this->assertEquals('N', $this->rover->direction());
    }

    public function testBeVerticallyOrienterdByDefault()
    {
        $this->assertEquals('vertical', $this->rover->orientation());
    }

    public function testChangeDirectionAfterTurnRight()
    {
        $this->assertEquals('N', $this->rover->direction());

        $this->rover->turnRight();
        $this->assertEquals('E', $this->rover->direction());

        $this->rover->turnRight();
        $this->assertEquals('S', $this->rover->direction());

        $this->rover->turnRight();
        $this->assertEquals('O', $this->rover->direction());

        $this->rover->turnRight();
        $this->assertEquals('N', $this->rover->direction());

        $this->rover->turnRight();
        $this->assertEquals('E', $this->rover->direction());
    }

    public function testChangeDirectionAfterTurnLeft()
    {
        $this->assertEquals('N', $this->rover->direction());

        $this->rover->turnLeft();
        $this->assertEquals('O', $this->rover->direction());

        $this->rover->turnLeft();
        $this->assertEquals('S', $this->rover->direction());

        $this->rover->turnLeft();
        $this->assertEquals('E', $this->rover->direction());

        $this->rover->turnLeft();
        $this->assertEquals('N', $this->rover->direction());

        $this->rover->turnLeft();
        $this->assertEquals('O', $this->rover->direction());
    }

    public function testChangeOrientationAfterRotation()
    {
        $this->rover->turnRight();
        $this->assertEquals([0, 0], $this->rover->position());
        $this->assertEquals('horizontal', $this->rover->orientation());
    }
}
