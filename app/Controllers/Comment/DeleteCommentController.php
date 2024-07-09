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
    public function delete(): RedirectResponse
    {
        $articleId = $_POST['article_id'];
        $commentId = $_POST['comment_id'];
        $this->deleteCommentService->deleteComment((int) $commentId);
        return new RedirectResponse('/articles/' . $articleId);
    }
}