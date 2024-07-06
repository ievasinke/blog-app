<?php declare(strict_types=1);

namespace App\Services\Article;

use App\Repositories\ArticleRepository;
use Exception;
use Monolog\Logger;

class DeleteArticleService
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
    public function deleteArticle(int $id): void
    {
        $this->logger->info(
            'Attempting to delete article',
            ['article_id' => $id]
        );
        try {
            $this->articleRepository->markAsDeleted($id);
            $this->logger->info(
                'Article deleted successfully',
                ['article id' => $id]
            );
        } catch (Exception $e) {
            $this->logger->error(
                'Error deleting article id ' . $id,
                [
                    'article_id' => $id,
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}