<?php declare(strict_types=1);

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use Exception;

class CreateCommentService
{
    protected $commentRepository;

    public function __construct(
        CommentRepositoryInterface $commentRepository
    )
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @throws Exception
     */
    public function createComment(
        int    $articleId,
        string $content,
        string $name
    ): int
    {
        //return 0;
        $result = $this->commentRepository->create(
            $articleId,
            $content,
            $name
        );
        if ($result === 0) {
            throw new Exception('Unable to create comment');
        }
        return $result;
    }
}