<?php declare(strict_types=1);

namespace App\Services\Article;

use App\Repositories\ArticleRepository;
use Exception;
use Monolog\Logger;

class CreateArticleService
{
    private ArticleRepository $articleRepository;
    private Logger $logger;

    public function __construct(
        ArticleRepository $articleRepository,
        Logger            $logger
    )
    {
        $this->articleRepository = $articleRepository;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function createArticle(
        string $author,
        string $title,
        string $content
    ): int
    {
        $this->logger->info(
            'Attempting to create article',
            [
                'author' => $author,
                'title' => $title
            ]);
        try {
            $result = $this->articleRepository->create(
                $author,
                $title,
                $content
            );
            $this->logger->info(
                'Article created successfully',
                ['article id' => $result]
            );
            return $result;
        } catch (Exception $e) {
            $this->logger->error(
                'Error creating article',
                [
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}