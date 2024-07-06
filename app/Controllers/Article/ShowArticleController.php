<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Response;
use App\Services\Article\ShowArticleService;
use Exception;

class ShowArticleController
{
    private ShowArticleService $showArticleService;
    public function __construct(ShowArticleService $showArticleService)
    {
        $this->showArticleService = $showArticleService;
    }

    /**
     * @throws Exception
     */
    public function show(int $id): Response
    {
        $article = $this->showArticleService->showArticle($id);
        return new Response(
            '/articles/show',
            ['article' => $article]
        );
    }
}