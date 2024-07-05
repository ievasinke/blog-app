<?php

use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use App\Controllers\Article\CreateArticleController;
use App\Controllers\Article\IndexArticleController;
use App\Controllers\Article\ShowArticleController;
use DI\ContainerBuilder;
use Medoo\Medoo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    Medoo::class => function () {
        return new Medoo([
            'type' => 'sqlite',
            'database' => 'storage/database.sqlite'
        ]);
    },
    Logger::class => function () {
        $log = new Logger('app');
        $logFile = __DIR__ . '/storage/logs/app.log';
        $log->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
        return $log;
    },
    ArticleRepository::class => DI\autowire(ArticleRepository::class),
    ArticleService::class => DI\create(ArticleService::class)
        ->constructor(DI\get(ArticleRepository::class), DI\get(Logger::class)),
    IndexArticleController::class => DI\autowire(IndexArticleController::class),
    ShowArticleController::class => DI\autowire(ShowArticleController::class),
    CreateArticleController::class => DI\autowire(CreateArticleController::class),
    ]);

return $containerBuilder->build();