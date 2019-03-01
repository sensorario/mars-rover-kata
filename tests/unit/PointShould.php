<?php

class PointShould extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function beCreatedFromOrigin()
    {
        $point = Point::fromOrigin();
        $this->assertEquals([ 'x' => 0, 'y' => 0 ], $point->toArray());
    }
}
