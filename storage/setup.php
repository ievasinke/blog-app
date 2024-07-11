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
like_count INTEGER NOT NULL DEFAULT 0,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at DATETIME,
deleted_at DATETIME
)");

$database->query("CREATE TABLE IF NOT EXISTS comments (
id INTEGER PRIMARY KEY AUTOINCREMENT,
article_id INTEGER NOT NULL,
content VARCHAR(555) NOT NULL,
name VARCHAR(32) NOT NULL,
like_count INTEGER NOT NULL DEFAULT 0,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
deleted_at DATETIME
FOREIGN KEY (article_id) REFERENCES articles(id)
)");

$database->query("CREATE TABLE IF NOT EXISTS likes (
id INTEGER PRIMARY KEY AUTOINCREMENT,
entity_id INTEGER NOT NULL,
type VARCHAR(20) NOT NULL,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)");

$database->query("CREATE INDEX entity_type_index ON likes (
entity_id, type
)");

echo "Database schema initialized.\n";