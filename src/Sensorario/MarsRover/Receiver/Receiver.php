<?php

namespace Sensorario\MarsRover\Receiver;

use PHPUnit\Framework\TestCase;
use Sensorario\MarsRover\Objects\Point;
use Sensorario\MarsRover\Rover;
use Sensorario\MarsRover\Grid;

class Receiver
{
    private $rover;

    private $grid;

    private $edgeDetected;

    private $obstacles = [];

    private $obstacleDetected = false;

    private $stepsMade = 0;

    private $fixer;

    private $predictor;

    public function __construct(
        Rover $rover,
        Grid $grid
    )
    {
        $this->rover = $rover;
        $this->grid = $grid;

        $this->fixer = new Fixer($this->grid);
        $this->predictor = new Predictor($this->rover);
    }

    public function setObstacles(array $obstacles) : void
    {
        $this->obstacles = $obstacles;
    }

    public function read(string $instruction) : void
    {
        for ($i = 0; $this->obstacleDetected === false && $i < strlen($instruction); $i++) {
            $this->move($instruction[$i]);
        }
    }

    public function move(string $instruction) : void
    {
        list($x, $y) = $this->predictor->forecastPosition($instruction);

        if ($this->edgeDetected = !$this->grid->containsPosition($x, $y)) {
            list($x, $y) = $this->fixer->fix($x, $y);
        }

        if (in_array([$x, $y], $this->obstacles)) {
            $currentPosition = $this->rover->position();
            $x = $currentPosition[0];
            $y = $currentPosition[1];
            $this->obstacleDetected = true;
        }

        if ($this->obstacleDetected === false) {
            $this->stepsMade++;
        }

        $this->rover->forcePosition(
            Point::from($x, $y)
        );
    }

    public function rover()
    {
        return $this->rover;
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
