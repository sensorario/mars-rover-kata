<?php

class Point
{
    private $x;

    private $y;

    private function __construct(
        int $x,
        int $y
    )
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function fromOrigin()
    {
        return new self(0, 0);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public static function from(int $x, int $y)
    {
        return new self($x, $y);
    }

    public function x()
    {
        return $this->x;
    }

    public function y()
    {
        return $this->y;
    }
}
