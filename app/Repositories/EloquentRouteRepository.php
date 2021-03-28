<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RouteRepositoryInterface;
use App\Models\Route;

class EloquentRouteRepository implements RouteRepositoryInterface
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
            Route::insertOrIgnore($chunk);
        }
    }
    
    /**
     * Returns all routes
     *
     * @return array
     */
    public function findAll(): array
    {
        return Route::all('source_id', 'destination_id', 'price', 'airline')->toArray();
    }
}
