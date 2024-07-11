<?php declare(strict_types=1);

use App\Controllers\Article\CreateArticleController;
use App\Controllers\Article\DeleteArticleController;
use App\Controllers\Article\IndexArticleController;
use App\Controllers\Article\ShowArticleController;
use App\Controllers\Article\UpdateArticleController;
use App\Controllers\Comment\CreateCommentController;
use App\Controllers\Comment\DeleteCommentController;
use App\Controllers\Comment\IndexCommentController;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Services\Article\CreateArticleService;
use App\Services\Article\DeleteArticleService;
use App\Services\Article\IndexArticleService;
use App\Services\Article\ShowArticleService;
use App\Services\Article\UpdateArticleService;
use App\Services\Comment\CreateCommentService;
use App\Services\Comment\DeleteCommentService;
use App\Services\Comment\IndexCommentService;
use DI\ContainerBuilder;
use Medoo\Medoo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use function DI\create;
use function DI\get;

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
    ArticleRepositoryInterface::class => create(ArticleRepository::class)
        ->constructor(get(Medoo::class)),
    'createArticleService' => create(CreateArticleService::class),
    'deleteArticleService' => create(DeleteArticleService::class),
    'indexArticleService' => create(IndexArticleService::class),
    'showArticleService' => create(ShowArticleService::class),
    'updateArticleService' => create(UpdateArticleService::class),
    'showArticleController' => create(ShowArticleController::class),
    'indexArticleController' => create(IndexArticleController::class),
    'createArticleController' => create(CreateArticleController::class),
    'updateArticleController' => create(UpdateArticleController::class),
    'deleteArticleController' => create(DeleteArticleController::class),
    CommentRepositoryInterface::class => create(CommentRepository::class)
        ->constructor(get(Medoo::class)),
    'createCommentService' => create(CreateCommentService::class),
    'deleteCommentService' => create(DeleteCommentService::class),
    'indexCommentService' => create(IndexCommentService::class),
    'createCommentController' => create(CreateCommentController::class),
    'deleteCommentController' => create(DeleteCommentController::class),
    'indexCommentController' => create(IndexCommentController::class),
]);

$container = $containerBuilder->build();
return $container;