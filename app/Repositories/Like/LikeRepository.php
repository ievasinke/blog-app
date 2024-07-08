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
    }

    public function getLikeCount(
        int    $entityId,
        string $type
    ): int
    {
        return $this->database->count(
            'likes',
            [
                'entity_id' => $entityId,
                'type' => $type,
            ]
        );
    }
}