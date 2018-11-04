<?php

namespace Sensorario\MarsRover\Receiver;

use PHPUnit\Framework\TestCase;
use Sensorario\MarsRover\Objects\Point;
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
        $this->rover->expects($this->once())
            ->method($movement);
        $this->rover->expects($this->any())
            ->method('position')
            ->willReturn([0,0]);
        $this->rover->expects($this->once())
            ->method('destination')
            ->willReturn(Point::from(0,0));

        $this->grid = $this
            ->getMockBuilder('Sensorario\MarsRover\Grid')
            ->disableOriginalConstructor()
            ->getMock();
        $this->grid->expects($this->once())
            ->method('containsPosition')
            ->with(0,0)
            ->willReturn(true);

        $translator = new Receiver(
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
            ['l', 'turnLeft'],
            ['r', 'turnRight'],
        ];
    }
}
