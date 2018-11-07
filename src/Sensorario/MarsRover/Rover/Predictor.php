<?php

namespace Sensorario\MarsRover\Rover;

use Sensorario\MarsRover\Rover\Rover;

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

            return $this->getForwardPosition($x, $y);
        }

        return $this->getBackwardPosition($x, $y);
    }

    private function getForwardPosition($x, $y)
    {
        if ($this->currentDirection === 'N') { return [$x, ++$y]; }
        if ($this->currentDirection === 'E') { return [++$x, $y]; }
        if ($this->currentDirection === 'O') { return [--$x, $y]; }

        return [$x, --$y];
    }

    public function getBackwardPosition($x, $y)
    {
        if ($this->currentDirection === 'N') { return [$x, --$y]; }
        if ($this->currentDirection === 'E') { return [--$x, $y]; }
        if ($this->currentDirection === 'O') { return [++$x, $y]; }

        return [$x, ++$y];
    }
}