<?php

require 'vendor/autoload.php';

use Medoo\Medoo;

$database = new Medoo([
    'type' => 'sqlite',
    'database' => 'storage/database.sqlite'
]);

$database->query("CREATE TABLE IF NOT EXISTS articles (
id INTEGER PRIMARY KEY AUTOINCREMENT,
author VARCHAR(255) NOT NULL,
title TEXT NOT NULL,
content TEXT NOT NULL,
created_at DATETIME NOT NULL,
updated_at DATETIME,
deleted_at DATETIME
)");

echo "Database schema initialized.\n";