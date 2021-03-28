<?php

namespace App\Interfaces\Repositories;

interface AirportRepositoryInterface
{
    /**
     * Bulk inserting airports
     *
     * @param array $data
     * @param int $chunkSize
     */
    public function chunkInsert(array $data, int $chunkSize): void;
    
    /**
     * Find all airport ids
     *
     * @return array
     */
    public function findAllIds(): array;
    
    /**
     *  Find airport by city
     *
     * @param string $city
     *
     * @return array|null
     */
    public function findByCity(string $city): ?array;
    
    /**
     * Find airports based on the ids provided
     *
     * @param array $ids
     *
     * @return array
     */
    public function findByIds(array $ids): array;
}
