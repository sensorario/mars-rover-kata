<?php

namespace Sensorario\MarsRover\Receiver;

use PHPUnit\Framework\TestCase;
use Sensorario\MarsRover\Point;
use Sensorario\MarsRover\Rover;

class ReceiverShould extends TestCase
{
    /** @dataProvider singleCommands */
    public function testConvertSingleInstructions($instruction, $movement)
    {
        $this->rover = $this
            ->getMockBuilder('Sensorario\MarsRover\Rover')
            ->disableOriginalConstructor()
            ->getMock();
        $this->rover->expects($this->any())
            ->method('position')
            ->willReturn([0,0]);

        $this->grid = $this
            ->getMockBuilder('Sensorario\MarsRover\Grid')
            ->disableOriginalConstructor()
            ->getMock();
        $this->grid->expects($this->once())
            ->method('containsPosition')
            ->with(0,0)
            ->willReturn(true);

        $this->predictor = $this
            ->getMockBuilder('Sensorario\MarsRover\Receiver\Predictor')
            ->disableOriginalConstructor()
            ->getMock();
        $this->predictor->expects($this->exactly(2))
            ->method('setRover')
            ->with($this->rover);
        $this->predictor->expects($this->once())
            ->method('forecast')
            ->with($instruction)
            ->willReturn([0, 0]);

        $translator = new Receiver(
            $this->predictor,
            $this->rover,
            $this->grid
        );

        $translator->read($instruction);
    }

    public function singleCommands()
    {
        return [
            ['f', 'moveForward'],
            ['b', 'moveBackword'],
            //['l', 'turnLeft'],
            //['r', 'turnRight'],
        ];
    }
}
