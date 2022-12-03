<?php

$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "music_hub";

$conn = mysqli_connect($db_server,$db_username,$db_password,$db_database);

if(!$conn) {
    echo "Database error",mysqli_connect_error();
}
 ?>