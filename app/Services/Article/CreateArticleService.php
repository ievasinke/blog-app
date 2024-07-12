<?php declare(strict_types=1);

namespace App\Services\Article;

use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Exceptions\FailedInsertIntoDatabaseException;
use App\Services\Exceptions\FailedToCreateArticleException;
use Exception;
use Psr\Log\LoggerInterface;

class CreateArticleService
{
    private ArticleRepositoryInterface $articleRepository;
    private LoggerInterface $logger;

    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        LoggerInterface            $logger
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
        } catch (FailedInsertIntoDatabaseException $exception) {
            throw new FailedToCreateArticleException(
                "Can't create article", //$exception->getMessage();
                $exception->getCode(),
                $exception
            );
        }
    }
}