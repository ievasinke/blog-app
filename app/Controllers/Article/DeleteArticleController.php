<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\RedirectResponse;
use App\Services\Article\DeleteArticleService;
use Exception;

class DeleteArticleController
{
    private DeleteArticleService $deleteArticleService;

    public function __construct(DeleteArticleService $deleteArticleService)
    {
        $this->deleteArticleService = $deleteArticleService;
    }

    /**
     * @throws Exception
     */
    public function delete(int $id): RedirectResponse
    {

        $this->deleteArticleService->deleteArticle($id);
        return new RedirectResponse('/articles');
    }
}