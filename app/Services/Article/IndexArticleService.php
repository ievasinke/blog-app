<?php declare(strict_types=1);

namespace App\Services\Article;

use App\Repositories\Article\ArticleRepository;
use Exception;
use Monolog\Logger;

class IndexArticleService
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
    public function getAll(): array
    {
        $this->logger->info('Retrieving all articles.');
        try {
            $result = $this->articleRepository->getArticles();
            $this->logger->info('Articles retrieved successfully.');
            return $result;
        } catch (Exception $e) {
            $this->logger->error(
                'Error retrieving articles',
                [
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}