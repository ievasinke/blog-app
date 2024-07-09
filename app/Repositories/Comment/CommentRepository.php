<?php declare(strict_types=1);

namespace App\Repositories\Comment;

use App\Models\Comment;
use Carbon\Carbon;
use Medoo\Medoo;

class CommentRepository implements CommentRepositoryInterface
{
    private Medoo $database;

    public function __construct(Medoo $database)
    {
        $this->database = $database;
    }

    public function create(
        int $articleId,
        string $content,
        string $name
    ): int
    {
        $this->database->insert(
            'comments',
            [
                'article_id' => $articleId,
                'content' => $content,
                'name' => $name,
                'created_at' => Carbon::now()->toISO8601String(),
            ]
        );
        return (int)$this->database->id();
    }

    public function getComments(int $articleId): array
    {
        $commentsData = $this->database->select(
            'comments',
            '*',
            [
                'article_id' => $articleId,
                'deleted_at' => null,
                'ORDER' => ['created_at' => 'DESC']
            ]
        );
        $comments = [];
        foreach ($commentsData as $comment) {
            $comments[] = $this->retrieveComment($comment);
        }
        return $comments;
    }

    public function getComment(int $id): ?Comment
    {
        $commentData = $this->database->select(
            'comments',
            '*',
            [
                'id' => $id,
                'deleted_at' => null,
            ]
        );
        return $commentData ? $this->retrieveComment($commentData) : null;
    }

    public function markAsDeleted(int $id): void
    {
        $this->database->update(
            'comments',
            [
                'deleted_at' => Carbon::now()->toIso8601String()
            ],
            [
                'id' => $id,
            ]
        );
    }

    private function retrieveComment(array $item): Comment
    {
        if (isset($item[0]) && is_array($item[0])) {
            $item = $item[0];
        }

        return new Comment(
            (int)$item['id'],
            (int)$item['article_id'],
            $item['content'],
            $item['name'],
            Carbon::parse($item['created_at']),
            Carbon::parse($item['deleted_at'])
        );
    }
}