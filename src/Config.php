<?php

class Config
{
    public static function map(string $movement)
    {
        $rightToLeftMap = [
            Direction::east() => Direction::north(),
            Direction::north() => Direction::west(),
            Direction::west() => Direction::south(),
            Direction::south() => Direction::east(),
        ];

        if ($movement == 'r') {
            return array_flip($rightToLeftMap);
        }

        return $rightToLeftMap;
    }
}
