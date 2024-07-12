<?php declare(strict_types=1);

namespace App\Services\Like;

use App\Repositories\Like\LikeRepositoryInterface;

class LikeService
{
    private LikeRepositoryInterface $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
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