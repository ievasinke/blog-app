<?php

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private int $id;
    private string $author;
    private string $title;
    private string $content;
    private string $createdAt;
    private string $updatedAt;
    private string $deletedAt;

    public function __construct(
        int     $id,
        string  $author,
        string  $title,
        string  $content,
        ?string $createdAt = null,
        ?string $updatedAt = null,
        ?string $deletedAt = null
    )
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->content = $content;
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

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): string
    {
        return $this->deletedAt;
    }
}