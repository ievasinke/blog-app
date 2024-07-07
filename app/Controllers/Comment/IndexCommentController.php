<?php declare(strict_types=1);

namespace App\Controllers\Comment;

use App\Response;
use App\Services\Comment\IndexCommentService;
use Exception;

class IndexCommentController
{
    private IndexCommentService $indexCommentService;
    public function __construct(IndexCommentService $indexCommentService)
    {
        $this->indexCommentService = $indexCommentService;
    }

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        $comments = $this->indexCommentService->getAll();
        return new Response(
            '/articles/show',
            ['comments' => $comments]
        );
    }
}