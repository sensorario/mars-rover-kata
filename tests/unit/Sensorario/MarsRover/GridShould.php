<?php

namespace Sensorario\MarsRover;

class GridShould extends \PHPUnit\Framework\TestCase
{
    /** @dataProvider sizes */
    public function testBeCreatedWithDimensions($width, $height, $matrix)
    {
        $grid = new Grid($width, $height);
        $this->assertEquals($matrix, $grid->matrix());
    }

    public function sizes()
    {
        return [
            [1, 1, [[0,0]]],
            [2, 2, [[0,0],[1,0],[0,1],[1,1]]],
            [1, 2, [[0,0],[0,1]]],
            [1, 3, [[0,0],[0,1],[0,2]]],
        ];
    }

    public function testDetectIfPointExists()
    {
        $grid = new Grid(3, 3);
        $this->assertSame(true, $grid->containsPosition(0, 0));
        $this->assertSame(false, $grid->containsPosition(4, 6));
    }
}
