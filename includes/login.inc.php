<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get information from user 
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');

    // Add post-process
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $login = new LoginCtrl($email, $pwd);
    $login->loginUser();

    // Back to home page
    header("location: ../index.php?login=success");
}