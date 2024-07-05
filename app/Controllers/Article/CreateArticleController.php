<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\RedirectResponse;
use App\Response;
use App\Services\ArticleService;

class CreateArticleController
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function createForm(): Response
    {
        return new Response(
            '/articles/create',
            []
        );
    }

    public function create(): RedirectResponse
    {
//        if (empty($author) || empty($title) || empty($content)) {
//            return new Response(
//                '/articles/create',
//                ['message' => 'All fields are required']
//            );
//        }

        $articleId = $this->articleService->createArticle(
            $_POST['author'],
            $_POST['title'],
            $_POST['content']
        );
        return new RedirectResponse('/articles/' . $articleId);
    }
}