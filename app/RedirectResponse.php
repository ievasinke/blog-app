<?php declare(strict_types=1);

namespace App;

class RedirectResponse
{
    private string $location;

    public function __construct(string $location)
    {
        $this->location = $location;
    }

    public function getLocation(): string
    {
        return $this->location;
    }
}