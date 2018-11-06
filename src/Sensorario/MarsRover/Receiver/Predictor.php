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

        if ($this->currentDirection === 'N') {
            if ($instruction === 'f') {
                $y++;
            }

            if ($instruction === 'b') {
                $y--;
            }
        }

        if ($this->currentDirection === 'E') {
            if ($instruction === 'f') {
                $x++;
            }

            if ($instruction === 'b') {
                $x--;
            }
        }

        if ($this->currentDirection === 'O') {
            if ($instruction === 'f') {
                $x--;
            }

            if ($instruction === 'b') {
                $x++;
            }
        }

        if ($this->currentDirection === 'S') {
            if ($instruction === 'f') {
                $y--;
            }

            if ($instruction === 'b') {
                $y++;
            }
        }

        return [
            $x,
            $y,
        ];
    }
}
