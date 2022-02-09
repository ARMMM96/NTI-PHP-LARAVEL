<?php
session_start();




// code 
if (count($_SESSION) > 0) {

    echo $_SESSION['Message'] . " : " .  $_SESSION['user']['name'];
    echo '<br/>';
    echo $_SESSION['user']['email'];

    echo '<br/>';
    echo '<br/>';

    foreach ($_SESSION['user'] as $key => $value) {
        # code...
        echo  $key . ' : ' . $value . '<br>';
    }
    
} else {
    echo ' No Session <br> ';
}


// session_destroy();
