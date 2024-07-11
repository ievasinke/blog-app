<?php declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private int $id;
    private string $author;
    private string $title;
    private string $content;
    private int $likeCount;
    private Carbon $createdAt;
    private ?Carbon $updatedAt;
    private ?Carbon $deletedAt;

    public function __construct(
        int     $id,
        string  $author,
        string  $title,
        string  $content,
        int     $likeCount,
        ?Carbon $createdAt = null,
        ?Carbon $updatedAt = null,
        ?Carbon $deletedAt = null
    )
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->content = $content;
        $this->likeCount = $likeCount;
        $this->createdAt = $createdAt ? Carbon::parse($createdAt) : Carbon::now();
        $this->updatedAt = $updatedAt ? Carbon::parse($updatedAt) : null;
        $this->deletedAt = $deletedAt ? Carbon::parse($deletedAt) : null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?Carbon
    {
        return $this->deletedAt;
    }
}