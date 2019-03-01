<?php

class DirectionShould extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function throwExceptionmWhenStringIsInvalid()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Unexpected direction value!');

        Direction::fromString('X');
    }

    /** @test @dataProvider cardinals*/
    public function beCreateWithCardinalValues($dir)
    {
        $direction = Direction::fromString($dir);
        $this->assertEquals([ 'direction' => $dir ], $direction->toArray());
    }

    public function cardinals()
    {
        return [
            ['N', 'S', 'W', 'E'],
        ];
    }
}
