<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\RedirectResponse;
use App\Response;
use App\Services\Article\ShowArticleService;
use App\Services\Article\UpdateArticleService;

class UpdateArticleController
{
    private ShowArticleService $showArticleService;
    private UpdateArticleService $updateArticleService;

    public function __construct(ShowArticleService $showArticleService, UpdateArticleService $updateArticleService)
    {
        $this->showArticleService = $showArticleService;
        $this->updateArticleService = $updateArticleService;
    }

    /**
     * @throws \Exception
     */
    public function updateForm(int $id): Response
    {
        $article = $this->showArticleService->showArticle($id);

        return new Response(
            '/articles/update',
            ['article' => $article]
        );
    }

    /**
     * @throws \Exception
     */
    public function update(int $id): RedirectResponse
    {
        $author = (string)$_POST['author'] ?? null;
        $title = (string)$_POST['title'] ?? null;
        $content = (string)$_POST['content'] ?? null;

        $this->updateArticleService->editArticle(
            $id,
            $author,
            $title,
            $content
        );
        return new RedirectResponse('/articles/' . $id);
    }
}