<?php

use App\Controllers\Article\IndexArticleController;
use App\Controllers\Article\ShowArticleController;

return [
    ['GET', '/articles', [IndexArticleController::class, 'index']],
    ['GET', '/articles/{id:\d+}', [ShowArticleController::class, 'show']],
];