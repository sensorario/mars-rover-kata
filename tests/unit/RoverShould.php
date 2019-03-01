<?php

class RoverShould extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function startFromOrigin()
    {
        $rover = new Rover();

        $this->assertEquals(Point::fromOrigin(), $rover->position());
        $this->assertEquals(Direction::north(), $rover->direction());
    }

    /** @test */
    public function moveForeward()
    {
        $rover = new Rover();
        $rover->receive(['f']);

        $this->assertEquals(Point::from(0, 1), $rover->position());
    }

    /** @test */
    public function moveBackward()
    {
        $rover = new Rover();
        $rover->receive(['b']);

        $this->assertEquals(Point::from(0, -1), $rover->position());
    }

    /** @test */
    public function turnLeft()
    {
        $rover = new Rover();
        $rover->receive(['l']);

        $this->assertEquals(Point::from(0, 0), $rover->position());
        $this->assertEquals(Direction::west(), $rover->direction());

        $rover->receive(['l']);
        $this->assertEquals(Direction::south(), $rover->direction());

        $rover->receive(['l']);
        $this->assertEquals(Direction::east(), $rover->direction());

        $rover->receive(['l']);
        $this->assertEquals(Direction::north(), $rover->direction());
    }

    /** @test */
    public function turnRight()
    {
        $rover = new Rover();
        $rover->receive(['r']);

        $this->assertEquals(Point::from(0, 0), $rover->position());
        $this->assertEquals(Direction::east(), $rover->direction());

        $rover->receive(['r']);
        $this->assertEquals(Direction::south(), $rover->direction());

        $rover->receive(['r']);
        $this->assertEquals(Direction::west(), $rover->direction());

        $rover->receive(['r']);
        $this->assertEquals(Direction::north(), $rover->direction());
    }
}
