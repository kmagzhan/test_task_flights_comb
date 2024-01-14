<?php

include './func.php';

$flights = [
    [
        'from' => 'a',
        'to' => 'b',
        'depart' => 1,
        'arrival' => 2
    ],
    [
        'from' => 'b',
        'to' => 'a',
        'depart' => 3,
        'arrival' => 4
    ],
    [
        'from' => 'a',
        'to' => 't',
        'depart' => 5,
        'arrival' => 6
    ],
    [
        'from' => 'a',
        'to' => 'x',
        'depart' => 5,
        'arrival' => 6
    ]
];

$graph = generateGraph($flights);

/**
 * Деает обход в глубину и создает
 * всевозможные комбинации рейсов
 *
 * @param $flightInd
 * @param $path
 * @param $flights
 * @param $graph
 * @param $combinations
 * @return void
 */
function dfs($flightInd, &$path, $flights, $graph, &$combinations) {
    $path[] = $flightInd;

    if (count($graph[$flightInd])) {
        foreach ($graph[$flightInd] as $nextFlightInd) {
            dfs($nextFlightInd, $path, $flights, $graph, $combinations);
        }
    } else {
        $combinations[] = $path;
    }

    array_pop($path);
}

$combinations = [];

for ($i = 0; $i < count($flights); $i++) {
    $path = [];

    dfs($i, $path, $flights, $graph, $combinations);
}

$maxDelta = -1;

$combinationWithMaxDelta = null;

foreach ($combinations as $comb) {
    $firstFlight = $comb[0];

    $lastFlight = $comb[count($comb) - 1];

    $delta = $lastFlight['arr'] - $firstFlight['dep'];

    if ($delta > $maxDelta) {
        $maxDelta = $delta;

        $combinationWithMaxDelta = $comb;
    }
}

print_r($combinationWithMaxDelta);
