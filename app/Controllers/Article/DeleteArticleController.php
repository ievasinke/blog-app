<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\RedirectResponse;
use App\Services\ArticleService;

class DeleteArticleController
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function delete(int $id): RedirectResponse
    {

        $this->articleService->deleteArticle($id);
        return new RedirectResponse('/articles');
    }
}