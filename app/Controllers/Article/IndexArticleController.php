<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Response;
use App\Services\ArticleService;

class IndexArticleController
{
    private ArticleService $articleService;
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(): Response
    {
        $articles = $this->articleService->getAll();
        return new Response(
            '/articles/index',
            ['articles' => $articles]
        );
    }
}