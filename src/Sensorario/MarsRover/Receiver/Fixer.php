<?php

namespace Sensorario\MarsRover\Receiver;

use Sensorario\MarsRover\Grid;

class Fixer
{
    private $grid;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    public function fix($x, $y)
    {
        $maxX = $this->grid->width() - 1;
        $maxY = $this->grid->height() - 1;

        if ($y > $maxY) {
            $y = 0;
        }

        if ($y < 0) {
            $y = $maxY;
        }

        if ($x > $maxX) {
            $x = 0;
        }

        if ($x < 0) {
            $x = $maxX;
        }

        return [$x, $y];
    }
}
