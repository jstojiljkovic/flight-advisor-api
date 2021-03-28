<?php

namespace App\Services;

use App\Helpers\FileContentParser;
use App\Interfaces\Repositories\AirportRepositoryInterface;
use App\Interfaces\Repositories\CityRepositoryInterface;
use App\Interfaces\Services\AirportServiceInterface;
use Illuminate\Http\UploadedFile;

class AirportService implements AirportServiceInterface
{
    /**
     * @var AirportRepositoryInterface
     */
    protected AirportRepositoryInterface $airportRepository;
    
    /**
     * @var CityRepositoryInterface
     */
    protected CityRepositoryInterface $cityRepository;
    
    /**
     * AirportService constructor.
     *
     * @param AirportRepositoryInterface $airportRepository
     * @param CityRepositoryInterface $cityRepository
     */
    public function __construct(AirportRepositoryInterface $airportRepository, CityRepositoryInterface $cityRepository)
    {
        $this->airportRepository = $airportRepository;
        $this->cityRepository = $cityRepository;
    }
    
    /**
     * Import airports
     *
     * @param UploadedFile $file
     *
     */
    public function import(UploadedFile $file): void
    {
        $airportsData = FileContentParser::toArray([ 'id', 'name', 'city', 'country', 'iata', 'icao',
            'latitude', 'longitude', 'altitude', 'timezone', 'dst', 'tz', 'type', 'source' ], $file, ',');
        
        $cities = $this->cityRepository->findAllNames();
        
        $data = array_filter($airportsData, function ($var) use ($cities) {
            return ( in_array($var['city'], $cities) );
        });
        
        $this->airportRepository->chunkInsert($data, 50);
    }
}
