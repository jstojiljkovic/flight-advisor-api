<?php


namespace App\Interfaces\Repositories;


interface CommentRepositoryInterface
{
    /**
     * Updates comment
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function update(int $id, array $data): array;
    
    /**
     * Checks whenever comment exists
     *
     * @param int $id
     *
     * @return bool
     */
    public function exists(int $id): bool;
    
    /**
     * Deletes comment
     *
     * @param int $id
     */
    public function delete(int $id): void;
}
