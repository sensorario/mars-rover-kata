<?php

namespace Sensorario\MarsRover;

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
            'position' => $this->receiver->roverPosition(),
            'edgeDetected' => $this->receiver->edgeDetected(),
            'direction' => $this->receiver->roverDirection(),
        ], JSON_PRETTY_PRINT);
    }
}
