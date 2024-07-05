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

    public function createArticle(string $author, string $title, string $content): int
    {
        return $this->articleRepository->create($author, $title, $content);
    }

    public function getAll(): array
    {
        return $this->articleRepository->getArticles();
    }

    public function showArticle(int $id): Article
    {
        return $this->articleRepository->getArticle($id);
    }

    public function editArticle(int $id, string $author, string $title, string $content): void{
        $this->articleRepository->updateArticle($id, $author, $title, $content);
    }
}