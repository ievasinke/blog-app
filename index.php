<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\RedirectResponse;
use App\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;


$loader = new FilesystemLoader(__DIR__ . '/views');
$twig = new Environment($loader, ['cache' => false]);

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $routes = include('routes.php');
    foreach ($routes as $route) {
        [$method, $path, $controller] = $route;
        $r->addRoute($method, $path, $controller);
    }
});

$container = require 'phpDi.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case Dispatcher::FOUND:
        [$controller, $method] = $routeInfo[1];
        $vars = $routeInfo[2];

        $controllerInstance = $container->get($controller);

        $vars = array_map(function ($value, $key) {
            if ($key === 'id') {
                return (int)$value;
            }
            return $value;
        }, $vars, array_keys($vars));

        /** @var Response $response
         ** @var RedirectResponse $response
         **/

        $response = $controllerInstance->$method(...array_values($vars));
        try {

            if ($response instanceof Response) {
                echo $twig->render(
                    $response->getTemplate() . '.html.twig',
                    $response->getData()
                );
            }

            if ($response instanceof RedirectResponse) {
                var_dump($response->getLocation());
                header('Location: ' . $response->getLocation());
            }
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            echo ':?';
//            echo $e->getMessage();
        }
        break;
}
