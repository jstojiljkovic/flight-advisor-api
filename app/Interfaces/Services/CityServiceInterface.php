<?php

namespace App\Interfaces\Services;

interface CityServiceInterface
{
    /**
     * Stores city
     *
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array;
    
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
     * Stores city's comment
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function storeComment(int $id, array $data): array;
}
