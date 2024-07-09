<?php declare(strict_types=1);

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepository;
use Exception;
use Monolog\Logger;

class DeleteCommentService
{
    private CommentRepository $commentRepository;
    private Logger $logger;

    public function __construct(
        CommentRepository $commentRepository,
        Logger            $logger
    )
    {
        $this->commentRepository = $commentRepository;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function deleteComment(int $id): void
    {
        $this->logger->info(
            'Attempting to delete comment',
            [
                'comment_id' => $id,
            ]
        );
        try {
            $this->logger->info(
                'Comment deleted successfully',
                [
                    'comment_id' => $id
                ]
            );
            $this->commentRepository->markAsDeleted($id);
        } catch (Exception $e) {
            $this->logger->error(
                'Error deleting comment id ' . $id,
                [
                    'comment_id' => $id,
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}