<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Response;
use App\Services\ArticleService;

class ShowArticleController
{
    private ArticleService $articleService;
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    public function show(int $id): Response
    {
        $article = $this->articleService->showArticle($id);
        return new Response(
            '/articles/show',
            ['article' => $article]
        );
    }
}