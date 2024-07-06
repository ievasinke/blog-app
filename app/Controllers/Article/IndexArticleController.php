<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\Response;
use App\Services\Article\IndexArticleService;
use Exception;

class IndexArticleController
{
    private IndexArticleService $indexArticleService;
    public function __construct(IndexArticleService $indexArticleService)
    {
        $this->indexArticleService = $indexArticleService;
    }

    /**
     * @throws Exception
     */
    public function index(): Response
    {
        $articles = $this->indexArticleService->getAll();
        return new Response(
            '/articles/index',
            ['articles' => $articles]
        );
    }
}