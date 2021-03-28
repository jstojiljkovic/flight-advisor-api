<?php

namespace App\Interfaces\Repositories;

interface CityRepositoryInterface
{
    /**
     * Creates city model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array;
    
    /**
     * Returns all cities with the number of comments provided
     *
     * @param int|null $comments
     *
     * @return array
     */
    public function getAll(?int $comments): array;
    
    /**
     * Returns all cities with the number of comments provided
     *
     * @param string $name
     * @param int|null $comments
     *
     * @return array
     */
    public function getByName(string $name, ?int $comments): array;
    
    /**
     * Checks if city exists by id
     *
     * @param int $id
     *
     * @return bool
     */
    public function existsById(int $id): bool;
    
    /**
     * Checks if city exists by name
     *
     * @param string $name
     *
     * @return bool
     */
    public function existsByName(string $name): bool;
    
    /**
     * Find all cities names
     *
     * @return array
     */
    public function findAllNames(): array;
    
    /**
     * Adds comment to the city
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function addComment(int $id, array $data): array;
}
