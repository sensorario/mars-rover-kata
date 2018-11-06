<?php

namespace Sensorario\MarsRover\Objects;

class Point
{
    private $x;

    private $y;

    private function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function from(int $x, int $y)
    {
        return new self($x, $y);
    }

    public static function origin()
    {
        return new self(0, 0);
    }

    public function toArray()
    {
        return [
            $this->x,
            $this->y,
        ];
    }
}
