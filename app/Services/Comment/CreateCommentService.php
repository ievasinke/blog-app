<?php declare(strict_types=1);

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepositoryInterface;
use Exception;
use Monolog\Logger;

class CreateCommentService
{
    private CommentRepositoryInterface $commentRepository;
    private Logger $logger;

    public function __construct(
        CommentRepositoryInterface $commentRepository,
        Logger            $logger
    )
    {
        $this->commentRepository = $commentRepository;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function createComment(
        int $articleId,
        string $content,
        string $name
    ): int
    {
        $this->logger->info(
            'Attempting to create comment on article' .  $articleId,
            [
                'article_id' => $articleId,
                'content' => $content,
                'name' => $name
            ]);
        try {
            $result = $this->commentRepository->create(
                $articleId,
                $content,
                $name
            );
            $this->logger->info(
                'Comment created successfully',
                ['comment id' => $result]
            );
            return $result;
        } catch (Exception $e) {
            $this->logger->error(
                'Error creating comment',
                [
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}