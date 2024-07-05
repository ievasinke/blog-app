<?php

use App\Controllers\Article\CreateArticleController;
use App\Controllers\Article\IndexArticleController;
use App\Controllers\Article\ShowArticleController;

return [
    ['GET', '/articles', [IndexArticleController::class, 'index']],
    ['GET', '/articles/{id:\d+}', [ShowArticleController::class, 'show']],

    ['GET', '/articles/create', [CreateArticleController::class, 'createForm']],
    ['POST', '/articles/create', [CreateArticleController::class, 'create']],
];