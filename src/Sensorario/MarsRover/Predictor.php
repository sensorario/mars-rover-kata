<?php

namespace Sensorario\MarsRover;

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
        $fut = $futurePosition->toArray();

        return [$fut[0], $fut[1]];
    }
}
