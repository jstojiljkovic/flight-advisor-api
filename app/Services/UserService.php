<?php

namespace App\Services;

use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;
    
    /**
     * @var RoleRepositoryInterface
     */
    protected RoleRepositoryInterface $roleRepository;
    
    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    
    /**
     * Stores user with the default role
     *
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        $user = $this->userRepository->create($data);
    
        $role = $this->roleRepository->findOrCreate(['name' => 'Regular']);
    
        $this->userRepository->addRole($user['id'], $role['id']);
    
        return $user;
    }
}
