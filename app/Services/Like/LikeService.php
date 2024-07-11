<?php declare(strict_types=1);

namespace App\Services\Like;

use App\Repositories\Like\LikeRepository;

class LikeService
{
    private LikeRepository $likeRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function createLike(
        int $entityId,
        string $type
    ): void
    {
        $this->likeRepository->create($entityId, $type);
    }
}