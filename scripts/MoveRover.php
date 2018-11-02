<?php

require 'vendor/autoload.php';

$startigPoint = Sensorario\MarsRover\Objects\Point::center();
$rover = new Sensorario\MarsRover\Rover($startigPoint);
$receiver = new Sensorario\MarsRover\Receiver($rover, new Sensorario\MarsRover\Grid(7,7));

(new Sensorario\MarsRover\Resumer($receiver))->println();

$receiver->read('ffffff');

(new Sensorario\MarsRover\Resumer($receiver))->println();

$receiver->read('f');

(new Sensorario\MarsRover\Resumer($receiver))->println();

