<?php

require 'vendor/autoload.php';

$startigPoint = Sensorario\MarsRover\Point::origin();
$rover = new Sensorario\MarsRover\Rover($startigPoint);
$receiver = new Sensorario\MarsRover\Receiver\Receiver($rover, new Sensorario\MarsRover\Grid(7,7));

(new Sensorario\MarsRover\Resumer($receiver))->println('partenza');

$receiver->read('ffffff');

(new Sensorario\MarsRover\Resumer($receiver))->println('intermezzo');

$receiver->read('f');

(new Sensorario\MarsRover\Resumer($receiver))->println('arrivo');

