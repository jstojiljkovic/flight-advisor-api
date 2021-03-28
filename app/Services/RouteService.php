<?php

namespace App\Services;

use App\Helpers\FileContentParser;
use App\Interfaces\Repositories\AirportRepositoryInterface;
use App\Interfaces\Repositories\RouteRepositoryInterface;
use App\Interfaces\Services\RouteServiceInterface;
use Cache;
use Illuminate\Http\UploadedFile;

class RouteService implements RouteServiceInterface
{
    /**
     * @var RouteRepositoryInterface
     */
    protected RouteRepositoryInterface $routeRepository;
    
    /**
     * @var AirportRepositoryInterface
     */
    protected AirportRepositoryInterface $airportRepository;
    
    /**
     * RouteService constructor.
     *
     * @param RouteRepositoryInterface $routeRepository
     * @param AirportRepositoryInterface $airportRepository
     */
    public function __construct(RouteRepositoryInterface $routeRepository, AirportRepositoryInterface $airportRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->airportRepository = $airportRepository;
    }
    
    /**
     * Import airports
     *
     * @param UploadedFile $file
     *
     */
    public function import(UploadedFile $file): void
    {
        $routesData = FileContentParser::toArray([ 'airline', 'airline_id', 'source', 'source_id', 'destination',
            'destination_id', 'codeshare', 'stops', 'equipment', 'price' ], $file, ',');
        
        $airports = $this->airportRepository->findAllIds();
        
        $data = array_filter($routesData, function ($var) use ($airports) {
            return ( in_array($var['source_id'], $airports) && in_array($var['destination_id'], $airports) );
        });
        
        $this->routeRepository->chunkInsert($data, 50);
        
        if (Cache::has('routes')) {
            array_merge($data, Cache::get('routes'));
            Cache::put('routes', $data);
        } else {
            Cache::put('routes', $data);
        }
    }
}
