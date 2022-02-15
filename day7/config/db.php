<?php
// Create Connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_name);

// Check Connection
if (mysqli_connect_errno()) {
    echo 'Faild to connect to MYSQL' . mysqli_connect_errno();
}
