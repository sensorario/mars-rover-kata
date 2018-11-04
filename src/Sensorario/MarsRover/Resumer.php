<?php

namespace Sensorario\MarsRover;

/** @codeCoverageIgnore */
class Resumer
{
    private $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function println()
    {
        echo "\n" . json_encode([
            'description' => 'partenza',
            'position' => $this->receiver->rover()->position(),
            'edgeDetected' => $this->receiver->edgeDetected(),
            'direction' => $this->receiver->rover()->direction(),
        ], JSON_PRETTY_PRINT);
    }
}
