<?php
#use CONSTANTS for localhost, class, php, 123
$connection = new PDO("mysql:host=localhost;dbname=database_2110222", 'root', '');
$connection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


