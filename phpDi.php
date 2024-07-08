<?php declare(strict_types=1);

use App\Controllers\Comment\DeleteCommentController;
use App\Repositories\ArticleRepository;
use App\Controllers\Article\CreateArticleController;
use App\Controllers\Article\IndexArticleController;
use App\Controllers\Article\ShowArticleController;
use App\Controllers\Article\UpdateArticleController;
use App\Controllers\Article\DeleteArticleController;
use App\Services\Article\CreateArticleService;
use App\Services\Article\ShowArticleService;
use App\Services\Article\UpdateArticleService;
use App\Services\Article\DeleteArticleService;
use App\Services\Article\IndexArticleService;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Comment\CommentRepository;
use App\Controllers\Comment\CreateCommentController;
use App\Controllers\Comment\IndexCommentController;
use App\Services\Comment\CreateCommentService;
use App\Services\Comment\DeleteCommentService;
use App\Services\Comment\IndexCommentService;
use DI\ContainerBuilder;
use Medoo\Medoo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    Medoo::class => function (): Medoo {
        return new Medoo([
            'type' => 'sqlite',
            'database' => 'storage/database.sqlite'
        ]);
    },
    Logger::class => function (): Logger {
        $log = new Logger('app');
        $logFile = __DIR__ . '/storage/logs/app.log';
        $log->pushHandler(new StreamHandler(
            $logFile,
            Logger::DEBUG
            ));
        return $log;
    },
    ArticleRepository::class => DI\autowire(ArticleRepository::class),
    CreateArticleService::class => DI\create(CreateArticleService::class)
        ->constructor(
            DI\get(ArticleRepository::class),
            DI\get(Logger::class)
        ),
    DeleteArticleService::class => DI\create(DeleteArticleService::class)
        ->constructor(
            DI\get(ArticleRepository::class),
            DI\get(Logger::class)
        ),
    IndexArticleService::class => DI\create(IndexArticleService::class)
        ->constructor(
            DI\get(ArticleRepository::class),
            DI\get(Logger::class)
        ),
    ShowArticleService::class => DI\create(ShowArticleService::class)
        ->constructor(
            DI\get(ArticleRepository::class),
            DI\get(Logger::class)
        ),
    UpdateArticleService::class => DI\create(UpdateArticleService::class)
        ->constructor(
            DI\get(ArticleRepository::class),
            DI\get(Logger::class)
        ),
    IndexArticleController::class => DI\autowire(IndexArticleController::class),
    ShowArticleController::class => DI\autowire(ShowArticleController::class),
    CreateArticleController::class => DI\autowire(CreateArticleController::class),
    UpdateArticleController::class => DI\autowire(UpdateArticleController::class),
    DeleteArticleController::class => DI\autowire(DeleteArticleController::class),
    CommentRepositoryInterface::class => DI\autowire(CommentRepository::class),
    CommentRepository::class => DI\autowire(CommentRepository::class),
    CreateCommentService::class  => DI\create(CreateCommentService::class)
        ->constructor(
            DI\get(CommentRepositoryInterface::class),
            DI\get(Logger::class)
        ),
    DeleteCommentService::class  => DI\create(DeleteCommentService::class)
    ->constructor(
        DI\get(CommentRepository::class),
        DI\get(Logger::class)
    ),
    IndexCommentService::class => DI\create(IndexCommentService::class)
        ->constructor(
            DI\get(CommentRepositoryInterface::class),
            DI\get(Logger::class)
        ),
    CreateCommentController::class  => DI\create(CreateCommentController::class)
        ->constructor(
            DI\get(CreateCommentService::class),
            DI\get(Logger::class)
        ),
    DeleteCommentController::class  => DI\autowire(DeleteCommentController::class),
    IndexCommentController::class => DI\autowire(IndexCommentController::class),
    ]);

return $containerBuilder->build();