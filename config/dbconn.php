<?php
$config = [
    'HOST' => 'localhost',
    'USER' => 'root',
    'PASSWORD' => '',
    'DB_NAME' => 'yeticave',
];

$connect = mysqli_connect($config['HOST'], $config['USER'], $config['PASSWORD'], $config['DB_NAME']);
