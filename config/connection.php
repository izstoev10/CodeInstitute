<?php

session_start();

$con = mysqli_connect(HOST, USER, PASS, DB);

if(!$con)
    die('error while trying to connect');

mysqli_set_charset($con, "utf8");

?>