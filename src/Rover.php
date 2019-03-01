<?php

class Rover
{
    private $position;

    private $direction;

    public function __construct()
    {
        $this->position = Point::fromOrigin();
        $this->direction = Direction::north();
    }

    public function receive(array $commands)
    {
        $movement = current($commands);

        if ($movement == 'l' || $movement == 'r') {
            $map = Config::map($movement);
            $this->direction = $map[$this->direction];
        }

        $movements = [ 'f' => +1, 'b' => -1, ];

        if (isset($movements[$movement])) {
            $y = $this->position->y() + $movements[$movement];
            $this->position = Point::from($this->position->x(), $y);
        }
    }

    public function position() : Point
    {
        return $this->position;
    }

    public function direction()
    {
        return $this->direction;
    }
}
