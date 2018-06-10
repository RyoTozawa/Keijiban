<?php

require_once 'idiorm.php';

ORM::configure('mysql:host=localhost;dbname=intern');
ORM::configure('username', 'root');
ORM::configure('password', 'root');
ORM::configure('driver_options', [
    PDO::MYSQL_ATTR_INIT_COMMAND       => 'SET NAMES utf8',
    PDO::ATTR_EMULATE_PREPARES         => false,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
]);

?>