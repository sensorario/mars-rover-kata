<?php

class Direction
{
    private $direction;

    private function __construct(
        string $direction
    )
    {
        if (!in_array($direction, ['N', 'S', 'W', 'E'])) {
            throw new RuntimeException('Oops! Unexpected direction value!');
        }

        $this->direction = $direction;
    }

    public static function fromString(string $direction)
    {
        return new self($direction);
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public static function north()
    {
        return 'N';
    }

    public static function west()
    {
        return 'W';
    }

    public static function south()
    {
        return 'S';
    }

    public static function east()
    {
        return 'E';
    }
}
