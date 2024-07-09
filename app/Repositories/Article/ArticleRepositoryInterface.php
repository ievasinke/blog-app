<?php

namespace App\Repositories\Article;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function create(
        string $author,
        string $title,
        string $content
    ): int;

    public function getArticles(): array;

    public function getArticle(int $id): ?Article;

    public function updateArticle(
        int    $id,
        string $author,
        string $title,
        string $content
    ): void;

    public function markAsDeleted(int $id): void;
}