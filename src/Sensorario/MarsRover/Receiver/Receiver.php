<?php

namespace Sensorario\MarsRover\Receiver;

use PHPUnit\Framework\TestCase;
use Sensorario\MarsRover\Grid;
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

    private $predictor;

    public function __construct(
        Predictor $predictor,
        Rover $rover,
        Grid $grid
    )
    {
        $this->rover = $rover;
        $this->grid = $grid;
        $this->predictor = $predictor;

        $this->fixer = new Fixer($this->grid);
        $this->predictor->setRover($this->rover);
    }

    public function setObstacles(array $obstacles) : void
    {
        $this->obstacles = $obstacles;
    }

    public function read(string $instruction) : void
    {
        for ($i = 0; $this->obstacleDetected === false && $i < strlen($instruction); $i++) {
            if ($instruction[$i] === 'l') {
                $this->rover->turnLeft();
            }

            if ($instruction[$i] === 'r') {
                $this->rover->turnRight();
            }

            if ($instruction[$i] === 'f' || $instruction[$i] === 'b') {
                $this->move($instruction[$i]);
            }

            $this->predictor->setRover($this->rover);

            if ($this->obstacleDetected === false) {
                $this->stepsMade++;
            }
        }
    }

    public function move(string $instruction) : void
    {
        list($x, $y) = $this->predictor->forecast($instruction);

        if ($this->edgeDetected = !$this->grid->containsPosition($x, $y)) {
            list($x, $y) = $this->fixer->fix($x, $y);
        }

        if (in_array([$x, $y], $this->obstacles)) {
            list($x, $y) = $this->rover->position();
            $this->obstacleDetected = true;
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
