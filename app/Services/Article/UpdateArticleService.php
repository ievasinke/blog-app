<?php declare(strict_types=1);

namespace App\Services\Article;

use App\Repositories\ArticleRepository;
use Exception;
use Monolog\Logger;

class UpdateArticleService
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
    public function editArticle(
        int    $id,
        string $author,
        string $title,
        string $content
    ): void
    {
        $this->logger->info(
            'Attempting to update article',
            [
                'article_id' => $id,
                'author' => $author,
                'title' => $title
            ]);
        try {
            $this->articleRepository->updateArticle(
                $id,
                $author,
                $title,
                $content
            );
            $this->logger->info(
                'Article updated successfully',
                ['article id' => $id]
            );
        } catch (Exception $e) {
            $this->logger->error(
                'Error updating article',
                [
                    'article_id' => $id,
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}
