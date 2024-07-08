<?php

namespace App\Repositories\Like;

interface LikeRepositoryInterface
{
    public function create(
        int $entityId,
        string $type
    ): void;

    public function getLikeCount(
        int $entityId,
        string $type
    ): int;
}