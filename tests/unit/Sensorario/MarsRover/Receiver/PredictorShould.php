<?php

namespace Sensorario\MarsRover\Receiver;

use PHPUnit\Framework\TestCase;
use Sensorario\MarsRover\Point;
use Sensorario\MarsRover\Rover;

class PredictorShould extends TestCase
{
    /** @dataProvider forecasts */
    public function testDetectNextRoverPosition(
        $from,
        $direction,
        $movement,
        $forecast
    )
    {
        $this->rover = $this
            ->getMockBuilder('Sensorario\MarsRover\Rover')
            ->disableOriginalConstructor()
            ->getMock();
        $this->rover->expects($this->once())
            ->method('position')
            ->willReturn($from);
        $this->rover->expects($this->once())
            ->method('direction')
            ->willReturn($direction);

        $predictor = new Predictor();
        $predictor->setRover($this->rover);

        $this->assertEquals($forecast, $predictor->forecast($movement));
    }

    public function forecasts()
    {
        return [
            [ [1, 1], 'N', 'f', [1, 2], ],
            [ [1, 1], 'N', 'b', [1, 0], ],
            [ [1, 1], 'E', 'f', [2, 1], ],
            [ [1, 1], 'E', 'b', [0, 1], ],
            [ [1, 1], 'S', 'f', [1, 0], ],
            [ [1, 1], 'S', 'b', [1, 2], ],
            [ [1, 1], 'O', 'f', [0, 1], ],
            [ [1, 1], 'O', 'b', [2, 1], ],
        ];
    }
}
