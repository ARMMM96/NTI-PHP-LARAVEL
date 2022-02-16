<?php
require('config/config.php');

// Create Connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_name);


if (!$conn) {

    die('Error : ' . mysqli_connect_error());    // display error message ...  (echo exit())

}