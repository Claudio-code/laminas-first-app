<?php

$databaseConfig = [
  'db' => [
    'driver' => 'Pdo_mysql',
    'database' => getenv('MYSQL_DATABASE'),
    'host' => getenv('DATABASE_URL'),
    'username' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_ROOT_PASSWORD')
  ]
];