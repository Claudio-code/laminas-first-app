<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver'   => 'Pdo_mysql',
        'database' => getenv('MYSQL_DATABASE'),
        'host'     => getenv('DATABASE_URL'),
        'username' => getenv('MYSQL_USER'),
        'password' => getenv('MYSQL_ROOT_PASSWORD')
    ],
    'mail' => [
        'name'              => 'smtp.mailtrap.io',
        'host'              => 'smtp.mailtrap.io',
        'port'              => 2525,
        'connection_class'  => 'login',
        'connection_config' => [
            'from'     => 'soneca859@gmail.com',
            'username' => 'e0c167dac82442',
            'password' => 'fb0be4d1b0b336',
            'auth'     => 'CRAM-MD5',
        ],
    ]
];
