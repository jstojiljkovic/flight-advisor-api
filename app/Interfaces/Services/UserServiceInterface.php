<?php

namespace App\Interfaces\Services;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * Stores user with the default role
     *
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array;
}
