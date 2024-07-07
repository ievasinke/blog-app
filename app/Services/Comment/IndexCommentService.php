<?php declare(strict_types=1);

namespace App\Services\Comment;

use App\Repositories\Comment\CommentRepository;
use Exception;
use Monolog\Logger;

class IndexCommentService
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
    public function getAll($articleId): array
    {
        $this->logger->info('Retrieving all comments.');
        try {
            $result = $this->commentRepository->getComments($articleId);
            $this->logger->info('Comments retrieved successfully.');
            return $result;
        } catch (Exception $e) {
            $this->logger->error(
                'Error retrieving comments',
                [
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}