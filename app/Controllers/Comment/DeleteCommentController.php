<?php declare(strict_types=1);

namespace App\Controllers\Comment;

use App\RedirectResponse;
use App\Services\Comment\DeleteCommentService;
use Exception;

class DeleteCommentController
{
    private DeleteCommentService $deleteCommentService;

    public function __construct(DeleteCommentService $deleteCommentService)
    {
        $this->deleteCommentService = $deleteCommentService;
    }

    /**
     * @throws Exception
     */
    public function delete(int $id): RedirectResponse
    {
        $articleId = $this->deleteCommentService->deleteComment($id);
        return new RedirectResponse('/articles/' . $articleId);
    }
}