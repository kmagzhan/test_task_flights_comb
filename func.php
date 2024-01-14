<?php

/**
 * Проверяет можео ли соеденить 2 рейса
 *
 *
 * @param array $f1
 * @param array $f2
 * @return bool
 */
function canJoinFlights(array $f1, array $f2): bool {
    return $f1['to'] === $f2['from'] && $f1['arrival'] <= $f2['depart'];
}

/**
 * Создает матрицу смежности
 *
 * @param $flights
 * @return array
 */
function generateGraph($flights): array {
    $graph = array_fill(0, count($flights), []);

    for ($i = 0; $i < count($flights); $i++) {
        for ($j = 0; $j < count($flights); $j++) {
            if ($i === $j) {
                continue;
            }

            $f1 = $flights[$i];
            $f2 = $flights[$j];

            if (canJoinFlights($f1, $f2)) {
                $graph[$i][] = $j;
            }
        }
    }

    return $graph;
}
