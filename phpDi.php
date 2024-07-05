<?php

use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
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
    ArticleService::class => DI\autowire(ArticleService::class)
    ]);

return $containerBuilder->build();