<?php

namespace Sensorario\MarsRover;

use PHPUnit\Framework\TestCase;
use Sensorario\MarsRover\Objects\Point;
use Sensorario\MarsRover\Rover;

class Receiver
{
    private $rover;

    private $grid;

    private $edgeDetected;

    private $obstacles = [];

    private $obstacleDetected = false;

    private $stepsMade = 0;

    private $fixer;

    public function __construct(
        Rover $rover,
        Grid $grid
    )
    {
        $this->conversionMap = [
            'f' => 'moveForward',
            'b' => 'moveBackword',
            'l' => 'turnLeft',
            'r' => 'turnRight',
        ];

        $this->rover = $rover;
        $this->grid = $grid;

        $this->fixer = new Fixer($this->grid);
    }

    public function setObstacles(array $obstacles) : void
    {
        $this->obstacles = $obstacles;
    }

    public function read(string $instruction) : void
    {
        for ($i = 0; $this->obstacleDetected == false && $i < strlen($instruction); $i++) {
            $this->move($instruction[$i]);
        }
    }

    public function move(string $instruction) : void
    {
        $currentPosition = $this->rover->position();

        $command = $this->conversionMap[$instruction];
        $this->rover->$command();
        $futurePosition = $this->rover->destination();
        $fut = $futurePosition->toArray();
        $x = $fut[0];
        $y = $fut[1];

        $this->edgeDetected = !$this->grid->containsPosition($x, $y);

        if ($this->edgeDetected) {
            list($x, $y) = $this->fixer->fix($x, $y);
        }

        if (in_array([$x, $y], $this->obstacles)) {
            $x = $currentPosition[0];
            $y = $currentPosition[1];
            $this->obstacleDetected = true;
        }

        if ($this->obstacleDetected == false) {
            $this->stepsMade++;
        }

        $this->rover->forcePosition(
            Objects\Point::from($x, $y)
        );
    }

    public function roverPosition()
    {
        return $this->rover->position();
    }
    public function roverDirection()
    {
        return $this->rover->direction();
    }

    public function roverDestination() : Objects\Point
    {
        return $this->rover->destination();
    }

    public function edgeDetected()
    {
        return $this->edgeDetected ?? false;
    }

    public function stepsMade()
    {
        return $this->stepsMade;
    }
}
