<?php

require 'vendor/autoload.php';

$receiver = new Sensorario\MarsRover\Receiver\Receiver(
    new Sensorario\MarsRover\Receiver\Predictor(),
    new Sensorario\MarsRover\Rover(
        Sensorario\MarsRover\Objects\Point::origin()
    ),
    new Sensorario\MarsRover\Grid(7,7)
);

$receiver->setObstacles([
    [0, 3],
]);

(new Sensorario\MarsRover\Resumer($receiver))->println('partenza');

$receiver->read('ffffff');

(new Sensorario\MarsRover\Resumer($receiver))->println('intermezzo');
