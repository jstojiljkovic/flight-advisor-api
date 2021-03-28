<?php

namespace App\Services;

use App\Interfaces\Repositories\CityRepositoryInterface;
use App\Interfaces\Services\CityServiceInterface;

class CityService implements CityServiceInterface
{
    /**
     * @var CityRepositoryInterface
     */
    protected CityRepositoryInterface $cityRepository;
    
    /**
     * CityService constructor.
     *
     * @param CityRepositoryInterface $cityRepository
     */
    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }
    
    /**
     * Stores city
     *
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        return $this->cityRepository->create($data);
    }
    
    /**
     * Stores city's comment
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function storeComment(int $id, array $data): array
    {
        abort_unless($this->cityRepository->existsById($id), 404, 'City with the provided id does not exist.');
        
        return $this->cityRepository->addComment($id, $data);
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
        return $this->cityRepository->getAll($comments);
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
        return $this->cityRepository->getByName($name, $comments);
    }
}
