<?php

namespace Sensorario\MarsRover;

/** @codeCoverageIgnore */
class Resumer
{
    private $receiver;

    public function __construct(Receiver\Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function println(string $title)
    {
        echo "\n" . json_encode([
            'description' => strtoupper($title),
            'position' => $this->receiver->rover()->position(),
            'edgeDetected' => $this->receiver->edgeDetected(),
            'direction' => $this->receiver->rover()->direction(),
        ], JSON_PRETTY_PRINT);
    }
}
