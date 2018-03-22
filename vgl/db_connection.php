<?php

$conn = new mysqli('localhost', 'root', '');
if ($conn->connect_error) {
    die('Could not connect: ' . mysql_error());
}

mysqli_select_db($conn,"vgl");

?>