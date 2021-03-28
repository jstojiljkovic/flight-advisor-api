<?php

namespace App\Interfaces\Repositories;

use App\Models\Role;

interface RoleRepositoryInterface
{
    /**
     * Creates model if it does not exist else will return it
     *
     * @param array $data
     *
     * @return array
     */
    public function findOrCreate(array $data): array;
}
