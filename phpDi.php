<?php

use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use App\Controllers\Article\CreateArticleController;
use App\Controllers\Article\IndexArticleController;
use App\Controllers\Article\ShowArticleController;
use DI\ContainerBuilder;
use Medoo\Medoo;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    Medoo::class => function () {
        return new Medoo([
            'type' => 'sqlite',
            'database' => 'storage/database.sqlite'
        ]);
    },
    ArticleRepository::class => DI\autowire(ArticleRepository::class),
    ArticleService::class => DI\autowire(ArticleService::class),
    IndexArticleController::class => DI\autowire(IndexArticleController::class),
    ShowArticleController::class => DI\autowire(ShowArticleController::class),
    CreateArticleController::class => DI\autowire(CreateArticleController::class),
    ]);

return $containerBuilder->build();