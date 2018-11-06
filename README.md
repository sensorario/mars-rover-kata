# mars-rover-kata

## Install composer

```bash
make composer
```

## Run tests

```bash
make
```

## Coverage

```bash
make coverage
```

## Badges

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sensorario/mars-rover-kata/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sensorario/mars-rover-kata/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/sensorario/mars-rover-kata/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sensorario/mars-rover-kata/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/sensorario/mars-rover-kata/badges/build.png?b=master)](https://scrutinizer-ci.com/g/sensorario/mars-rover-kata/build-status/master) [![Code Intelligence Status](https://scrutinizer-ci.com/g/sensorario/mars-rover-kata/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

## TestDox

```bash
Sensorario\MarsRover\GridShould
 ✔ Be created with dimensions with data set #0 [2.16 ms]
 ✔ Be created with dimensions with data set #1 [0.16 ms]
 ✔ Be created with dimensions with data set #2 [0.14 ms]
 ✔ Be created with dimensions with data set #3 [0.14 ms]
 ✔ Detect if point exists [0.34 ms]

Sensorario\MarsRover\Receiver\PredictorShould
 ✔ Detect next rover position with data set #0 [7.83 ms]
 ✔ Detect next rover position with data set #1 [0.60 ms]
 ✔ Detect next rover position with data set #2 [0.56 ms]
 ✔ Detect next rover position with data set #3 [0.55 ms]
 ✔ Detect next rover position with data set #4 [0.55 ms]
 ✔ Detect next rover position with data set #5 [0.55 ms]
 ✔ Detect next rover position with data set #6 [0.56 ms]
 ✔ Detect next rover position with data set #7 [0.54 ms]

Sensorario\MarsRover\Receiver\ReceiverShould
 ✔ Convert single instructions with data set #0 [3.48 ms]
 ✔ Convert single instructions with data set #1 [1.29 ms]

Sensorario\MarsRover\RoverShould
 ✔ Start from center of the world [0.15 ms]
 ✔ Point to north by default [0.13 ms]
 ✔ Be vertically orienterd by default [0.13 ms]
 ✔ Change direction after turn right [0.20 ms]
 ✔ Change direction after turn left [0.20 ms]
 ✔ Change orientation after rotation [0.15 ms]

MovementShould
 ✔ Reach valid position [0.24 ms]
 ✔ Detect grid edge [0.20 ms]
 ✔ Wrap norwth edge [0.24 ms]
 ✔ Wrap west edge [0.21 ms]
 ✔ Wrap south edge [0.21 ms]
 ✔ Wrap east edge [0.26 ms]
 ✔ Complete sequence whenever obstacles are not present [0.35 ms]
 ✔ Stop sequence whenever obstacle is present [0.27 ms]

Time: 85 ms, Memory: 6.00MB

OK (29 tests, 64 assertions)
```
