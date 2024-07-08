<?php declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Like
{
    private int $id;
    private int $entityId;
    private string $type;
    private Carbon $createdAt;

    public function __construct(
        int $id,
        int $entityId,
        string $type,
        ?Carbon $createdAt = null
    )
    {
        $this->id = $id;
        $this->entityId = $entityId;
        $this->type = $type;
        $this->createdAt = $createdAt ? Carbon::parse($createdAt) : Carbon::now();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}