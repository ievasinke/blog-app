<?php declare(strict_types=1);

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Like\LikeRepository;
use App\Repositories\Like\LikeRepositoryInterface;
use DI\ContainerBuilder;
use Medoo\Medoo;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
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
    LoggerInterface::class => create(Logger::class),
    ArticleRepositoryInterface::class => create(ArticleRepository::class)
        ->constructor(get(Medoo::class)),
    CommentRepositoryInterface::class => create(CommentRepository::class)
        ->constructor(get(Medoo::class)),
    LikeRepositoryInterface::class => create(LikeRepository::class)
        ->constructor(get(Medoo::class)),
]);

$container = $containerBuilder->build();
return $container;