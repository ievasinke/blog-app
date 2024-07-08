<?php

use App\Controllers\Article\CreateArticleController;
use App\Controllers\Article\DeleteArticleController;
use App\Controllers\Article\IndexArticleController;
use App\Controllers\Article\ShowArticleController;
use App\Controllers\Article\UpdateArticleController;
use App\Controllers\Comment\CreateCommentController;
use App\Controllers\Comment\DeleteCommentController;

return [
    ['GET', '/articles', [IndexArticleController::class, 'index']],
    ['GET', '/articles/{id:\d+}', [ShowArticleController::class, 'show']],
    ['GET', '/articles/create', [CreateArticleController::class, 'createForm']],
    ['POST', '/articles/create', [CreateArticleController::class, 'create']],
    ['GET', '/articles/update/{id:\d+}', [UpdateArticleController::class, 'updateForm']],
    ['POST', '/articles/update/{id:\d+}', [UpdateArticleController::class, 'update']],
    ['GET', '/articles/delete/{id:\d+}', [DeleteArticleController::class, 'delete']],
    ['POST', '/comments/create', [CreateCommentController::class, 'create']],
    ['POST', '/comments/delete/{id:\d+}', [DeleteCommentController::class, 'delete']],
];