<?php
return [
    'csrf' => bin2hex(random_bytes(32)),
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=cheshire_cat',
        'user' => 'username',
        'password' => 'password'
    ]
];