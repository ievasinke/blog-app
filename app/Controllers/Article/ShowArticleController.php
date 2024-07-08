<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Models\Comment;
use App\Response;
use App\Services\Article\ShowArticleService;
use App\Services\Comment\IndexCommentService;
use App\Services\Like\LikeService;
use Exception;

class ShowArticleController
{
    private ShowArticleService $showArticleService;
    private IndexCommentService $indexCommentService;
    private LikeService $likeService;

    public function __construct(
        ShowArticleService  $showArticleService,
        IndexCommentService $indexCommentService,
        LikeService $likeService
    )
    {
        $this->showArticleService = $showArticleService;
        $this->indexCommentService = $indexCommentService;
        $this->likeService = $likeService;
    }

    /**
     * @throws Exception
     */
    public function show(int $id): Response
    {
        $article = $this->showArticleService->showArticle($id);
        $comments = $this->indexCommentService->getAll($id);

        $article->likeCount = $this->likeService->getLikeCount($article->getId(), 'article');

        array_map( function (Comment $comment): Comment {
            $comment->likeCount = $this->likeService->getLikeCount($comment->getId(), 'comment');
            return $comment;
        }, $comments);

        return new Response(
            '/articles/show',
            [
                'article' => $article,
                'comments' => $comments
            ]
        );
    }
}