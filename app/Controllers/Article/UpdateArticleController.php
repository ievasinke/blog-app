<?php declare(strict_types=1);

namespace App\Controllers\Article;

use App\RedirectResponse;
use App\Response;
use App\Services\Article\ShowArticleService;
use App\Services\Article\UpdateArticleService;
use Exception;
use Monolog\Logger;

class UpdateArticleController
{
    private ShowArticleService $showArticleService;
    private UpdateArticleService $updateArticleService;
    private Logger $logger;

    public function __construct(
        ShowArticleService $showArticleService,
        UpdateArticleService $updateArticleService,
        Logger $logger
    )
    {
        $this->showArticleService = $showArticleService;
        $this->updateArticleService = $updateArticleService;
        $this->logger = $logger;
    }

    /**
     * @throws \Exception
     */
    public function updateForm(int $id): Response
    {
        $article = $this->showArticleService->showArticle($id);

        return new Response(
            '/articles/update',
            ['article' => $article]
        );
    }

    /**
     * @throws \Exception
     */
    public function update(): RedirectResponse
    {
        $id = (int)$_POST['id'] ?? null;
        $author = (string)$_POST['author'] ?? null;
        $title = (string)$_POST['title'] ?? null;
        $content = (string)$_POST['content'] ?? null;

        if (empty($id) || empty($author) || empty($title) || empty($content)) {
            $errorMessage = 'All fields are required.';
            $this->logger->error('Error updating article: ' . $errorMessage);
            return new RedirectResponse('/articles/' . $id . '?error=' . urlencode($errorMessage));
        }

        try {
            $this->logger->info(
                'Attempting to update article' .  $id,
                [
                    'id' => $id,
                    'author' => $author,
                    'title' => $title,
                    'content' => $content
                ]);
            $this->updateArticleService->editArticle(
                $id,
                $author,
                $title,
                $content
            );
            $this->logger->info('Article updated successfully', ['article_id' => $id]);
            return new RedirectResponse('/articles/' . $id);
        } catch (Exception $e) {
            $this->logger->error('Error updating article', [
                'exception_message' => $e->getMessage(),
                'exception_stack' => $e->getTraceAsString()
            ]);
            $errorMessage = 'An error occurred while updating the article.';
            return new RedirectResponse('/articles/' . $id . '?error=' . urlencode($errorMessage));
        }
    }
}