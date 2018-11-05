<?php

namespace Sensorario\MarsRover\Receiver;

use Sensorario\MarsRover\Rover;

class Predictor
{
    private $conversionMap = [
        'f' => 'moveForward',
        'b' => 'moveBackword',
        'l' => 'turnLeft',
        'r' => 'turnRight',
    ];

    private $rover;

    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
    }

    public function forecastPosition($instruction)
    {
        $command = $this->conversionMap[$instruction];
        $this->rover->$command();
        $futurePosition = $this->rover->destination();
        return $futurePosition->toArray();
    }
}
