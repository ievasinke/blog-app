<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\RedirectResponse;
use App\Response;
use App\Services\Article\CreateArticleService;

class CreateArticleController
{
    private CreateArticleService $createArticleService;

    public function __construct(CreateArticleService $createArticleService)
    {
        $this->createArticleService = $createArticleService;
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

        $articleId = $this->createArticleService->createArticle(
            $_POST['author'],
            $_POST['title'],
            $_POST['content']
        );
        return new RedirectResponse('/articles/' . $articleId);
    }
}