<?php

namespace App\Interfaces\Services;

interface CommentServiceInterface
{
    /**
     * Stores city
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function update(int $id, array $data): array;
    
    /**
     * Stores city
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $id): void;
}
