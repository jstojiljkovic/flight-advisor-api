<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * Creates user model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ])->toArray();
    }
    
    /**
     * Attaches role to a user
     *
     * @param int $userId
     * @param int $roleId
     */
    public function addRole(int $userId, int $roleId): void
    {
        User::find($userId)
            ->roles()
            ->attach($roleId);
    }
}
