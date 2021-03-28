<?php

namespace App\Repositories;

use App\Interfaces\Repositories\AirportRepositoryInterface;
use App\Models\Airport;

class EloquentAirportRepository implements AirportRepositoryInterface
{
    /**
     * Bulk inserting airports
     *
     * @param array $data
     * @param int $chunkSize
     */
    public function chunkInsert(array $data, int $chunkSize): void
    {
        foreach (array_chunk($data, $chunkSize) as $chunk) {
            Airport::insertOrIgnore($chunk);
        }
    }
    
    /**
     * Find all airport ids
     *
     * @return array
     */
    public function findAllIds(): array
    {
        return Airport::all('id')->pluck('id')->toArray();
    }
    
    /**
     * Find airport by city
     *
     * @param string $city
     *
     * @return array
     */
    public function findByCity(string $city): ?array
    {
        $airport = Airport::where('city', $city)->first();
        
        return is_null($airport) ? null : $airport->toArray();
    }
    
    /**
     * Find airports based on the ids provided
     *
     * @param array $ids
     *
     * @return array
     */
    public function findByIds(array $ids): array
    {
        return Airport::whereIn('id', $ids)->get()->keyBy('id')->toArray();
    }
}
