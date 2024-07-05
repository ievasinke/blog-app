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