<?php
#REVISION HISTORY
#       NAME                                        DATE                        COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                   created connection array
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                   set connection to database

$connection = new PDO("mysql:host=localhost;dbname=database_2110222", 'Permissions', '1234');
$connection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


