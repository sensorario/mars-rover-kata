<?php

Namespace Sensorario\MarsRover;

class Rover
{
    private $directions = [
        'N',
        'E',
        'S',
        'O',
    ];

    private $currentDirection = 0;

    public function __construct(
        Objects\Point $startingPoint
    )
    {
        $this->position = $startingPoint;
    }

    public function forcePosition(Objects\Point $point)
    {
        $this->position = $point;
    }

    public function position() : array
    {
        return $this->position->toArray();
    }

    public function moveForward() : void
    {
        $this->move([
            'N' => 'incY',
            'S' => 'decY',
            'O' => 'decX',
            'E' => 'incX',
        ]);
    }

    public function moveBackword() : void
    {
        $this->move([
            'N' => 'decY',
            'S' => 'incY',
            'O' => 'incX',
            'E' => 'decX',
        ]);
    }

    private function move($movements)
    {
        $this->position->{$movements[$this->direction()]}();
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
}
