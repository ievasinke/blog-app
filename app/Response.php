<?php declare(strict_types=1);

namespace App;

class Response
{
    private string $template;
    private array $data;

    public function __construct(
        string $template,
        array  $data
    )
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getData(): array
    {
        if (!empty($_GET['error'])) {
            $this->data['error'] = $_GET['error'];
        }
        return $this->data;
    }
}