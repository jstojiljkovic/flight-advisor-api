<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CityRepositoryInterface;
use App\Models\City;

class EloquentCityRepository implements CityRepositoryInterface
{
    /**
     * Creates city model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array
    {
        return City::create($data)->toArray();
    }
    
    /**
     * Checks if city exists by name
     *
     * @param string $name
     *
     * @return bool
     */
    public function existsByName(string $name): bool
    {
        return City::where('name', $name)->exists();
    }
    
    /**
     * Find all cities
     *
     * @return array
     */
    public function findAllNames(): array
    {
        return City::all('name')->pluck('name')->toArray();
    }
    
    /**
     * Adds comment to the city
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function addComment(int $id, array $data): array
    {
        return City::find($id)->comments()->create($data)->toArray();
    }
    
    /**
     * Checks if city exists by id
     *
     * @param int $id
     *
     * @return bool
     */
    public function existsById(int $id): bool
    {
        return City::where('id', $id)->exists();
    }
    
    /**
     * Returns all cities with the number of comments provided
     *
     * @param int|null $comments
     *
     * @return array
     */
    public function getAll(?int $comments): array
    {
        $city = City::with('comments');
        
        if (is_null($comments)) {
            return $city->get()->toArray();
        }
        
        return $city->get()->map(function ($city) use ($comments) {
            return $city->setRelation('comments', $city->comments->take($comments));
        })->toArray();
    }
    
    /**
     * Returns all cities with the number of comments provided
     *
     * @param string $name
     * @param int|null $comments
     *
     * @return array
     */
    public function getByName(string $name, ?int $comments): array
    {
        $city = City::search($name)->with('comments');
        
        if (is_null($comments)) {
            return $city->get()->toArray();
        }
        
        return $city->get()->map(function ($city) use ($comments) {
            return $city->setRelation('comments', $city->comments->take($comments));
        })->toArray();
    }
}
