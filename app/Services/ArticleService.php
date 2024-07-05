<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Exception;
use Monolog\Logger;

class ArticleService
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