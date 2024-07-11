<?php declare(strict_types=1);

namespace App\Repositories\Like;

use Carbon\Carbon;
use Medoo\Medoo;

class LikeRepository implements LikeRepositoryInterface
{
    private Medoo $database;

    public function __construct(Medoo $database)
    {
        $this->database = $database;
    }
    public function create(
        int    $entityId,
        string $type
    ): void
    {
        $this->database->insert(
            'likes',
            [
                'entity_id' => $entityId,
                'type' => $type,
                'created_at' => Carbon::now()->toIso8601String(),
            ]
        );

        if ($type === 'article') {
            $this->incrementArticleLikeCount($entityId);
        } elseif ($type === 'comment') {
            $this->incrementCommentLikeCount($entityId);
        }
    }

    private function incrementArticleLikeCount(int $articleId): void
    {
        $this->database->update(
            'articles',
            ['like_count[+]' => 1],
            ['id' => $articleId]
        );
    }

    private function incrementCommentLikeCount(int $commentId): void
    {
        $this->database->update(
            'comments',
            ['like_count[+]' => 1],
            ['id' => $commentId]
        );
    }
}