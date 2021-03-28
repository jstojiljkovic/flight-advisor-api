<?php

namespace App\Interfaces\Services;

interface FlightServiceInterface
{
    /**
     * Finds cheapest flight between two cities
     *
     * @param string $city1
     * @param string $city2
     *
     * @return array
     */
    public function findCheapest(string $city1, string $city2): array;
}
