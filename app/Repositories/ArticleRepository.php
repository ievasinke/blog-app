<?php declare(strict_types=1);

namespace App\Repositories;
use App\Models\Article;
use Carbon\Carbon;
use Medoo\Medoo;

class ArticleRepository
{
    private Medoo $database;

    public function __construct(Medoo $database)
    {
        $this->database = $database;
    }

    public function create(string $author, string $title, string $content): int
    {
        $this->database->insert(
            'articles',
            [
                'author' => $author,
                'title' => $title,
                'content' => $content,
                'created_at' => Carbon::now()->toIso8601String(),
            ]
        );
        return (int)$this->database->id();
    }

    public function getArticles(): array
    {
        $articlesData = $this->database->select(
            'articles', '*',
            ['deleted_at' => null]
        );
        $articles = [];
        foreach ($articlesData as $article) {
            $articles[] = $this->retrieveArticle($article);
        }
        return $articles;
    }

    public function getArticle(int $id): ?Article
    {
        $article = $this->database->select('articles', '*', ['id' => $id]);
        return $article ? $this->retrieveArticle($article) : null;
    }

    public function updateArticle(int $id, string $author, string $title, string $content): void
    {
        $this->database->update(
            'articles',
            [
                'author' => $author,
                'title' => $title,
                'content' => $content,
                'updated_at' => Carbon::now()->toIso8601String()
            ],
            [
                'id' => $id
            ]
        );
    }

    private function retrieveArticle(array $item): Article
    {
        if (isset($item[0]) && is_array($item[0])) {
            $item = $item[0];
        }

        return new Article(
            (int)$item['id'],
            $item['author'],
            $item['title'],
            $item['content'],
            Carbon::parse($item['created_at']),
            Carbon::parse($item['updated_at']),
            Carbon::parse($item['deleted_at'])
        );
    }
}