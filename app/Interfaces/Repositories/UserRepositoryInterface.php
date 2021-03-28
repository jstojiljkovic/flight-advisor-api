<?php

namespace App\Interfaces\Repositories;

interface UserRepositoryInterface
{
    /**
     * Creates user model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array;
    
    /**
     * Attaches role to a user
     *
     * @param int $userId
     * @param int $roleId
     */
    public function addRole(int $userId, int $roleId): void;
}
