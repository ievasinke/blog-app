<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;

class ArticleService
{
    private ArticleRepository $articleRepository;
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAll(): array
    {
        return $this->articleRepository->getArticles();
    }

    public function showArticle(int $id): Article
    {
        $article = $this->articleRepository->getArticle($id);
        return $article;
    }
}