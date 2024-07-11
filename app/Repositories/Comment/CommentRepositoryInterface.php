<?php

namespace App\Repositories\Comment;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function create(
        int $articleId,
        string $content,
        string $name
    ): int;

    public function getComments(int $articleId): array;

    public function getComment(int $id): ?Comment;

    public function markAsDeleted(int $id): void;
}