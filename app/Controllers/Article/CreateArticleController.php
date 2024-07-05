<?php

namespace App\Controllers\Article;

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

    public function create(): ?Response
    {
        $author = (string)$_POST['author'] ?? null;
        $title = (string)$_POST['title'] ?? null;
        $content = (string)$_POST['content'] ?? null;

        if (empty($author) || empty($title) || empty($content)) {
            return new Response(
                '/articles/create',
                ['message' => 'All fields are required']
            );
        }

        $articleId = $this->articleService->createArticle($author, $title, $content);
        header("Location: /articles/" . $articleId, true, 301);
        return null;
    }
}