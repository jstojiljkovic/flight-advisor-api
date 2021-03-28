<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Models\Role;

class EloquentRoleRepository implements RoleRepositoryInterface
{
    /**
     * Creates model if it does not exist else will return it
     *
     * @param array $data
     *
     * @return array
     */
    public function findOrCreate(array $data): array
    {
        return Role::firstOrCreate($data)->toArray();
    }
}
