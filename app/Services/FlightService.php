<?php

namespace App\Services;

use App\Abstractions\Graph\DijkstraGraph;
use App\Interfaces\Repositories\AirportRepositoryInterface;
use App\Interfaces\Repositories\CityRepositoryInterface;
use App\Interfaces\Repositories\RouteRepositoryInterface;
use App\Interfaces\Services\FlightServiceInterface;
use Cache;

class FlightService implements FlightServiceInterface
{
    /**
     * @var AirportRepositoryInterface
     */
    protected AirportRepositoryInterface $airportRepository;
    
    /**
     * @var RouteRepositoryInterface
     */
    protected RouteRepositoryInterface $routeRepository;
    
    /**
     * @var CityRepositoryInterface
     */
    protected CityRepositoryInterface $cityRepository;
    
    /**
     * @var DijkstraGraph
     */
    protected DijkstraGraph $dijkstraGraph;
    
    /**
     * FlightService constructor.
     *
     * @param AirportRepositoryInterface $airportRepository
     * @param RouteRepositoryInterface $routeRepository
     * @param CityRepositoryInterface $cityRepository
     * @param DijkstraGraph $dijkstraGraph
     */
    public function __construct(
        AirportRepositoryInterface $airportRepository,
        RouteRepositoryInterface $routeRepository,
        CityRepositoryInterface $cityRepository,
        DijkstraGraph $dijkstraGraph
    )
    {
        $this->airportRepository = $airportRepository;
        $this->routeRepository = $routeRepository;
        $this->cityRepository = $cityRepository;
        $this->dijkstraGraph = $dijkstraGraph;
    }
    
    /**
     * Finds cheapest flight between two cities
     *
     * @param string $city1
     * @param string $city2
     *
     * @return array
     */
    public function findCheapest(string $city1, string $city2): array
    {
        $airport1 = $this->airportRepository->findByCity($city1);
        
        abort_if(is_null($airport1), 404, 'Airport in the city ' . $city1 . ' does not exist.');
        
        $airport2 = $this->airportRepository->findByCity($city2);
        
        abort_if(is_null($airport2), 404, 'Airport in the city ' . $city2 . ' does not exist.');
        
        $routes = Cache::get('routes');
        dump($routes);
        $graph = $this->dijkstraGraph->createGraph($routes, 'source_id', 'destination_id', 'price');
        
        $cheapestPath = $this->dijkstraGraph->shortestPath($airport1['id'], $airport2['id']);
        
        $airports = $this->airportRepository->findByIds($cheapestPath);
      
        $cheapestRoute = [];
        $price = 0;
        foreach ($cheapestPath as $key => $element) {
            $airport = $airports[$element];
            if ($key === array_key_first($cheapestPath)) {
                $cheapestRoute['start'] = $this->getRouteInformation($airport);
                $price += $graph[$cheapestPath[$key]][$cheapestPath[$key + 1]];
            } elseif ($key === array_key_last($cheapestPath)) {
                $cheapestRoute['end'] = $this->getRouteInformation($airport);
            } else {
                $cheapestRoute['through'][] = $this->getRouteInformation($airport);
                $price += $graph[$cheapestPath[$key]][$cheapestPath[$key + 1]];
            }
        }
        
        $cheapestRoute['price'] = $price;
        
        return $cheapestRoute;
    }
    
    /**
     * @param array $airport
     *
     * @return array
     */
    private function getRouteInformation(array $airport)
    {
        return [
            'airline' => $airport['name'],
            'city' => $airport['city'],
            'country' => $airport['country']
        ];
    }
}
