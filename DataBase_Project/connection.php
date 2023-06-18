<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'AsdfGhjkL123.');
define('DB_NAME', 'projectDBLC');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("Error, could not connect." .mysqli_connect_error());
}

?>