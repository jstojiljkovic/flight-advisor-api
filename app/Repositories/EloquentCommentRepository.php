<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CommentRepositoryInterface;
use App\Models\Comment;

class EloquentCommentRepository implements CommentRepositoryInterface
{
    /**
     * Updates comment
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $comment = Comment::find($id);
        $comment->update($data);
        
        return $comment->toArray();
    }
    
    /**
     * Checks whenever comment exists
     *
     * @param int $id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        return Comment::where('id', $id)->exists();
    }
    
    /**
     * Deletes comment
     *
     * @param int $id
     *
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        Comment::find($id)->delete();
    }
}
