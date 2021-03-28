<?php

namespace App\Services;

use App\Interfaces\Repositories\CommentRepositoryInterface;
use App\Interfaces\Services\CommentServiceInterface;

class CommentService implements CommentServiceInterface
{
    /**
     * @var CommentRepositoryInterface
     */
    protected CommentRepositoryInterface $commentRepository;
    
    /**
     * CommentService constructor.
     *
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    
    /**
     * Stores city
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function update(int $id, array $data): array
    {
        abort_unless($this->commentRepository->exists($id), 404, 'Comment with the provided id does not exist.');
        
        return $this->commentRepository->update($id, $data);
    }
    
    /**
     * Stores city
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $id): void
    {
        abort_unless($this->commentRepository->exists($id), 404, 'Comment with the provided id does not exist.');
        
        $this->commentRepository->delete($id);
    }
}
