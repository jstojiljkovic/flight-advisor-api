<?php

namespace App\Abstractions\Graph;

use Fisharebest\Algorithm\Dijkstra;

class DijkstraGraph extends Graph
{
    /**
     * Finds the shortest path based on the dijkstra algorithm
     *
     * @param $source
     * @param $destination
     *
     * @return array
     */
    function shortestPath($source, $destination): array
    {
        $algorithm = new Dijkstra($this->graph);

        $path = $algorithm->shortestPaths($source, $destination);

        return empty($path) ? [] : $path[0];
    }
}
