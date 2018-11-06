<?php

namespace Sensorario\MarsRover\Receiver;

use Sensorario\MarsRover\Rover;

class Predictor
{
    private $rover;

    private $currentPosition;

    private $currentDirection;

    public function setRover(Rover $rover)
    {
        $this->rover = $rover;

        $this->currentPosition = $this->rover->position();
        $this->currentDirection = $this->rover->direction();
    }

    public function forecast($instruction)
    {
        $x = $this->currentPosition[0];
        $y = $this->currentPosition[1];

        if ($instruction === 'f') {
            if ($this->currentDirection === 'N') { return [$x, ++$y]; }
            if ($this->currentDirection === 'E') { return [++$x, $y]; }
            if ($this->currentDirection === 'O') { return [--$x, $y]; }
            if ($this->currentDirection === 'S') { return [$x, --$y]; }
        }

        if ($instruction === 'b') {
            if ($this->currentDirection === 'N') { return [$x, --$y]; }
            if ($this->currentDirection === 'E') { return [--$x, $y]; }
            if ($this->currentDirection === 'O') { return [++$x, $y]; }
            if ($this->currentDirection === 'S') { return [$x, ++$y]; }
        }
    }
}
