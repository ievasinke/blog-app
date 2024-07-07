<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Response;
use App\Services\Article\ShowArticleService;
use App\Services\Comment\IndexCommentService;
use Exception;

class ShowArticleController
{
    private ShowArticleService $showArticleService;
    private IndexCommentService $indexCommentService;

    public function __construct(
        ShowArticleService  $showArticleService,
        IndexCommentService $indexCommentService
    )
    {
        $this->showArticleService = $showArticleService;
        $this->indexCommentService = $indexCommentService;
    }

    /**
     * @throws Exception
     */
    public function show(int $id): Response
    {
        $article = $this->showArticleService->showArticle($id);
        $comments = $this->indexCommentService->getAll($id);
        return new Response(
            '/articles/show',
            [
                'article' => $article,
                'comments' => $comments
            ]
        );
    }
}