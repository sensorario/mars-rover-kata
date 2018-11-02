<?php

namespace Sensorario\MarsRover;

class Grid
{
    private $grid = [];

    private $width;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $this->grid[] = [$x, $y];
            }
        }
    }

    public function matrix()
    {
        return $this->grid;;
    }

    public function containsPosition($x, $y) : bool
    {
        return in_array([$x, $y], $this->grid);
    }

    public function width()
    {
        return $this->width;
    }

    public function height()
    {
        return $this->height;
    }
}
