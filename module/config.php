<?php

require_once(dirname(__FILE__).'/idiorm.php');

ORM::configure('mysql:host=localhost;dbname=intern');
ORM::configure('username', 'root');
ORM::configure('password', 'root');
ORM::configure('port', '3306');
?>