<?php

require 'vendor/autoload.php';

use Medoo\Medoo;

$database = new Medoo([
    'type' => 'sqlite',
    'database' => 'storage/database.sqlite'
]);

$database->query("CREATE TABLE IF NOT EXISTS articles (
id INTEGER PRIMARY KEY AUTOINCREMENT,
author VARCHAR(32) NOT NULL,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at DATETIME,
deleted_at DATETIME
)");

$database->query("CREATE TABLE IF NOT EXISTS comments (
id INTEGER PRIMARY KEY AUTOINCREMENT,
article_id INTEGER NOT NULL,
content VARCHAR(555) NOT NULL,
name VARCHAR(32) NOT NULL,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
deleted_at DATETIME
FOREIGN KEY (article_id) REFERENCES articles(id)
)");

echo "Database schema initialized.\n";