<?php

namespace App\Controllers\Article;

use App\RedirectResponse;
use App\Response;
use App\Services\ArticleService;

class UpdateArticleController
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function updateForm(int $id): Response
    {
        $article = $this->articleService->showArticle($id);

        return new Response(
            '/articles/update',
            ['article' => $article]
        );
    }

    public function update(int $id): RedirectResponse
    {
        $author = (string)$_POST['author'] ?? null;
        $title = (string)$_POST['title'] ?? null;
        $content = (string)$_POST['content'] ?? null;

        $this->articleService->editArticle($id, $author, $title, $content);
        return new RedirectResponse('/articles/' . $id);
    }
}