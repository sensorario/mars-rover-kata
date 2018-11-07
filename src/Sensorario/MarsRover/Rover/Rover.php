<?php

namespace Sensorario\MarsRover\Rover;

use Sensorario\MarsRover\Objects\Point;

class Rover
{
    private $directions = [
        'N',
        'E',
        'S',
        'O',
    ];

    private $currentDirection = 0;

    private $destination;

    private $position;

    public function __construct(
        Point $startingPoint
    )
    {
        $this->position = $startingPoint;
        $this->destination = $this->position;
    }

    public function forcePosition(Point $Point)
    {
        $this->position = $Point;
    }

    public function position() : array
    {
        return $this->position->toArray();
    }

    public function direction() : string
    {
        return $this->directions[$this->currentDirection];
    }

    public function turnRight()
    {
        $this->currentDirection++;
        $this->refreshCurrentDirection();
    }

    public function turnLeft()
    {
        $this->currentDirection--;

        if ($this->currentDirection == -1) {
            $this->currentDirection += $this->numOfDirections();
        }

        $this->refreshCurrentDirection();
    }

    private function refreshCurrentDirection()
    {
        $this->currentDirection = $this->currentDirection % $this->numOfDirections();
    }

    private function numOfDirections()
    {
        return count($this->directions);
    }

    public function orientation()
    {

        return $this->currentDirection % 2
            ? 'horizontal'
            : 'vertical';
    }

    public function destination() : Point
    {
        return $this->destination;
    }
}
