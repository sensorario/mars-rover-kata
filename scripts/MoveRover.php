<?php

require 'vendor/autoload.php';

$receiver = new Sensorario\MarsRover\Receiver\Receiver(
    new Sensorario\MarsRover\Rover\Predictor(),
    new Sensorario\MarsRover\Rover\Rover(
        Sensorario\MarsRover\Objects\Point::origin()
    ),
    new Sensorario\MarsRover\Grid(7,7)
);

(new Sensorario\MarsRover\Resumer($receiver))->println('partenza');

$receiver->read('ffffff');

(new Sensorario\MarsRover\Resumer($receiver))->println('intermezzo');

$receiver->read('f');

(new Sensorario\MarsRover\Resumer($receiver))->println('arrivo');

