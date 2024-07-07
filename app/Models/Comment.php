<?php

namespace App\Models;

use Carbon\Carbon;

class Comment
{
    private int $id;
    private int $articleId;
    private string $content;
    private string $name;
    private Carbon $createdAt;
    private ?Carbon $deletedAt;

    public function __construct(
        int $id, int $articleId,
        string $content,
        string $name,
        ?Carbon $createdAt = null,
        ?Carbon $deletedAt = null
    )
    {
        $this->id = $id;
        $this->articleId = $articleId;
        $this->content = $content;
        $this->name = $name;
        $this->createdAt = $createdAt ? Carbon::parse($createdAt) : Carbon::now();
        $this->deletedAt = $deletedAt ? Carbon::parse($deletedAt) : null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getDeletedAt(): ?Carbon
    {
        return $this->deletedAt;
    }
}