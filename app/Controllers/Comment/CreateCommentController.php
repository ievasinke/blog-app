<?php declare(strict_types=1);

namespace App\Controllers\Comment;

use App\RedirectResponse;
use App\Response;
use App\Services\Comment\CreateCommentService;
use Exception;
use Monolog\Logger;

class CreateCommentController
{
    private CreateCommentService $createCommentService;
    private Logger $logger;

    public function __construct(
        CreateCommentService $createCommentService,
        Logger               $logger
    )
    {
        $this->createCommentService = $createCommentService;
        $this->logger = $logger;
    }

    public function createForm(): Response
    {
        return new Response(
            '/comment/create',
            []
        );
    }

    /**
     * @throws Exception
     */
    public function create(): RedirectResponse
    {
        $articleId = $_POST['article_id'] ?? null;
        $content = $_POST['content'] ?? null;
        $name = $_POST['name'] ?? null;

        if (empty($articleId) || empty($content) || empty($name)) {
            $errorMessage = 'All fields are required.';
            $this->logger->error('Error creating comment: ' . $errorMessage);
            return new RedirectResponse('/articles/' . $articleId . '?error=' . urlencode($errorMessage));
        }

        try {
            $commentId = $this->createCommentService->createComment(
                (int)$articleId,
                $content,
                $name
            );
            $this->logger->info('Comment created successfully', ['comment_id' => $commentId]);
            return new RedirectResponse('/articles/' . $articleId);
        } catch (Exception $e) {
            $this->logger->error('Error creating comment', [
                'exception_message' => $e->getMessage(),
                'exception_stack' => $e->getTraceAsString()
            ]);
            $errorMessage = 'An error occurred while creating the comment.';
            return new RedirectResponse('/articles/' . $articleId . '?error=' . urlencode($errorMessage));
        }
    }
}