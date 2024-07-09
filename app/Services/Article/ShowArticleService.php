<?php declare(strict_types=1);

namespace App\Services\Article;

use App\Models\Article;
use App\Repositories\Article\ArticleRepository;
use Exception;
use Monolog\Logger;

class ShowArticleService
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
    public function showArticle(int $id): Article
    {
        $this->logger->info(
            'Retrieving article',
            ['article_id' => $id]
        );
        try {
            $result = $this->articleRepository->getArticle($id);
            $this->logger->info(
                'Article retrieved successfully.',
                ['article id' => $id]
            );
            return $result;
        } catch (Exception $e) {
            $this->logger->error(
                'Error retrieving article',
                [
                    'article_id' => $id,
                    'exception_message' => $e->getMessage(),
                    'exception_stack' => $e->getTraceAsString()
                ]);
            throw $e;
        }
    }
}
