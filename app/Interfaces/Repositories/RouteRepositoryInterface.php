<?php

namespace App\Interfaces\Repositories;

interface RouteRepositoryInterface
{
    /**
     * Bulk inserting airports
     *
     * @param array $data
     * @param int $chunkSize
     */
    public function chunkInsert(array $data, int $chunkSize): void;
    
    /**
     * Returns all routes
     *
     * @return array
     */
    public function findAll(): array;
}
