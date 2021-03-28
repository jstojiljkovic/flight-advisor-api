<?php

namespace App\Abstractions\Graph;

abstract class Graph
{
    /**
     * @var array
     */
    protected array $graph = [];

    /**
     * Finds the shortest path based on the dijkstra algorithm
     *
     * @param $source
     * @param $destination
     *
     * @return array
     */
    abstract function shortestPath($source, $destination): array;

    /**
     * Creates graph based on the array provided
     *
     * @param array $array
     * @param $node1
     * @param $node2
     * @param $cost
     *
     * @return array
     */
    public function createGraph(array $array, $node1, $node2, $cost): array
    {
        foreach ($array as $item) {
            if (isset($this->graph[$item[$node1]][$item[$node2]])) {
                if ($this->graph[$item[$node1]][$item[$node2]] > $item[$cost]) {
                    $this->graph[$item[$node1]][$item[$node2]] = $item[$cost];
                }
            } else {
                $this->graph[$item[$node1]][$item[$node2]] = $item[$cost];
            }
        }

        return $this->graph;
    }
}
