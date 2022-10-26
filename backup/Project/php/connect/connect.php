<?php
    $host = 'localhost';
    $user = 'bb020440';
    $password = 'jobsbe000!!';
    $db = 'bb020440';
    $connect = new mysqli($host, $user, $password, $db);
    $connect -> set_charset("utf8");

    // if(mysqli_connect_errno()) {
    //     echo "Database Connect False <br>";
    // }
    // else {
    //     echo "Database Connect True <br>";
    // }
?>